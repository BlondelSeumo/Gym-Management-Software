<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymClient;
use App\Models\GymPurchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymClientReportController extends GymAdminBaseController
{
    public function __construct() {
        parent::__construct();

        $this->data['reportMenu'] = 'active';
        $this->data['clientreportMenu'] = 'active';
    }

    public function index() {
        if (!$this->data['user']->can("view_client_report")) {
            return App::abort(401);
        }
        $this->data['title'] = 'Client Reports';
        return View::make('gym-admin.reports.client.index', $this->data);
    }

    public function store() {
        $validator = Validator::make(Input::all(), ['client_type' => 'required', 'date_range' => 'required']);

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }
        else {
            $choice = Input::get('client_type');
            $date_range = explode('-', Input::get('date_range'));

            $date_range_start = Carbon::createFromFormat('M d, Y', trim($date_range[0]));
            $date_range_end = Carbon::createFromFormat('M d, Y', trim($date_range[1]));
            $total = 0;
            $report = '';

            switch ($choice) {
                case 'new':
                    $total = GymClient::join('business_customers','business_customers.customer_id','=','gym_clients.id')
                        ->whereBetween('gym_clients.joining_date', [$date_range_start->format('Y-m-d'), $date_range_end->format('Y-m-d')])
                        ->where('business_customers.detail_id', '=', $this->data['user']->detail_id)->count();

                    $report = 'New Clients';
                    break;
                case 'expire':
                    $purchases = GymPurchase::whereBetween('purchase_date', [$date_range_start->format('Y-m-d'), $date_range_end->format('Y-m-d')])
                        ->leftJoin('gym_clients', 'gym_clients.id', '=', 'gym_client_purchases.client_id')
                        ->whereNull('gym_clients.deleted_at')
                        ->where('gym_client_purchases.detail_id', '=', $this->data['user']->detail_id)
                        ->get();
                    $expire = array();
                    foreach ($purchases as $purchase) {
                        if ($purchase->membership_id != null) {
                            $days = $purchase->start_date->diffInDays(Carbon::now('Asia/Calcutta'));

                            if ($purchase->membership->duration > $days && ($purchase->membership->duration - $days) < 10) {
                                $flag = 1;
                            }
                            else {
                                $flag = 0;
                            }
                            $expire[] = [
                                'user' => $purchase->client_id,
                                'flag' => $flag
                            ];
                        }
                    }
                    $total = 0;
                    $user = array();
                    foreach ($expire as $ex) {
                        if ($ex['flag'] == 1) {
                            $total++;
                            array_push($user, $ex['user']);
                        }
                    }

                    $report = 'Expiring Clients';
                    break;
                case 'big_spenders':
                    $total = GymPurchase::whereBetween('purchase_date', [$date_range_start->format('Y-m-d'), $date_range_end->format('Y-m-d')])
                        ->where('detail_id', '=', $this->data['user']->detail_id)
                        ->where('purchase_amount', '>', 10000)->count();
                    $report = 'Big Clients';
                    break;
                case 'birthday':
                    if ($date_range_start->month > $date_range_end->month) {
                        $clients = GymClient::select('first_name', 'last_name', 'email', 'mobile', 'gender', 'gym_clients.id as clientID')
                            ->join('business_customers','business_customers.customer_id','=','gym_clients.id')
                            ->whereRaw("DAYOFYEAR(gym_clients.dob)>= '" . $date_range_start->dayOfYear . "' OR DAYOFYEAR(gym_clients.dob) <='" . $date_range_end->dayOfYear . "' AND business_customers.detail_id =" . $this->data['user']->detail_id)
                            ->count();

                    }
                    else {
                        $clients = GymClient::select('first_name', 'last_name', 'email', 'mobile', 'gender', 'gym_clients.id as clientID')
                            ->join('business_customers','business_customers.customer_id','=','gym_clients.id')
                            ->whereRaw("DAYOFYEAR(gym_clients.dob)>= '" . $date_range_start->dayOfYear . "' AND DAYOFYEAR(gym_clients.dob) <='" . $date_range_end->dayOfYear . "' AND business_customers.detail_id =" . $this->data['user']->detail_id)
                            ->count();

                    }
                    $total = $clients;

                    $report = 'Clients BirthDays';
                    break;
                case 'lost':
                    $purchases = GymPurchase::whereBetween('purchase_date', [$date_range_start->format('Y-m-d'), $date_range_end->format('Y-m-d')])
                        ->where('detail_id', '=', $this->data['user']->detail_id)
                        ->get();
                    $total = 0;
                    foreach ($purchases as $purchase) {
                        if ($purchase->membership_id != null) {
                            $days = $purchase->start_date->diffInDays(Carbon::now('Asia/Calcutta'));

                            if ($purchase->membership->duration < $days) {
                                $total++;
                            }
                        }
                    }
                    $report = 'Lost Clients';
                    break;
                case 'default':
                    $total = 0;
                    $report = 'Invalid Request';
            }

            $data = [
                'total' => $total,
                'start_date' => $date_range_start->format('Y-m-d'),
                'end_date' => $date_range_end->format('Y-m-d'),
                'type' => $choice,
                'report' => $report
            ];

            return Reply::successWithData('Reports Fetched', $data);
        }
    }

    public function ajax_create($type, $start_date, $end_date) {
        $clients = null;
        switch ($type) {
            case 'new':
                $clients = GymClient::select('first_name', 'last_name', 'email', 'mobile', 'gender', 'gym_clients.id as clientID')
                    ->join('business_customers','business_customers.customer_id','=','gym_clients.id')
                    ->whereBetween('gym_clients.joining_date', [$start_date, $end_date])
                    ->where('business_customers.detail_id', '=', $this->data['user']->detail_id)
                    ->get();
                break;
            case 'expire':
                $purchases = GymPurchase::whereBetween('purchase_date', [$start_date, $end_date])
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->get();
                $expire = array();
                foreach ($purchases as $purchase) {
                    if ($purchase->membership_id != null) {
                        $days = $purchase->start_date->diffInDays(Carbon::now('Asia/Calcutta'));

                        if ($purchase->membership->duration > $days && ($purchase->membership->duration - $days) < 10) {
                            $flag = 1;
                        }
                        else {
                            $flag = 0;
                        }
                        $expire[] = [
                            'user' => $purchase->client_id,
                            'flag' => $flag
                        ];
                    }
                }
                $users = array();
                foreach ($expire as $ex) {
                    if ($ex['flag'] == 1) {
                        if (!in_array($ex['user'], $users)) {
                            array_push($users, $ex['user']);
                        }
                    }
                }
                $clients = GymClient::select('first_name', 'last_name', 'email', 'mobile', 'gender')
                    ->whereIn('id', $users)
                    ->get();
                break;
            case 'big_spenders':
                $clients = GymPurchase::select('first_name', 'last_name', 'email', 'mobile', 'gender', 'gym_clients.id as clientID')
                    ->leftJoin('gym_clients', 'gym_clients.id', '=', 'gym_client_purchases.client_id')
                    ->leftJoin('business_customers','business_customers.customer_id','=','gym_clients.id')
                    ->whereBetween('purchase_date', [$start_date, $end_date])
                    ->where('business_customers.detail_id', '=', $this->data['user']->detail_id)
                    ->where('purchase_amount', '>', 10000)->get();
                break;
            case 'birthday':
                $start = Carbon::createFromFormat('Y-m-d', $start_date);
                $end = Carbon::createFromFormat('Y-m-d', $end_date);
                if ($start->month > $end->month) {
                    $clients = GymClient::select('first_name', 'last_name', 'email', 'mobile', 'gender', DB::raw('DATE_FORMAT(dob, "%d %M, %Y")'), 'gym_clients.id as clientID')
                        ->join('business_customers','business_customers.customer_id','=','gym_clients.id')
                        ->whereRaw("DAYOFYEAR(gym_clients.dob)>= '" . $start->dayOfYear . "' OR DAYOFYEAR(gym_clients.dob) <='" . $end->dayOfYear . "' AND business_customers.detail_id =" . $this->data['user']->detail_id)
                        ->get();

                }
                else {
                    $clients = GymClient::select('first_name', 'last_name', 'email', 'mobile', 'gender', DB::raw('DATE_FORMAT(dob, "%d %M, %Y")'), 'gym_clients.id as clientID')
                        ->join('business_customers','business_customers.customer_id','=','gym_clients.id')
                        ->whereRaw("DAYOFYEAR(gym_clients.dob)>= '" . $start->dayOfYear . "' AND DAYOFYEAR(gym_clients.dob) <='" . $end->dayOfYear . "' AND business_customers.detail_id =" . $this->data['user']->detail_id)
                        ->get();

                }


                break;
            case 'lost':
                $purchases = GymPurchase::whereBetween('purchase_date', [$start_date, $end_date])
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->get();
                $users = array();
                foreach ($purchases as $purchase) {
                    if ($purchase->membership_id != null) {
                        $days = $purchase->start_date->diffInDays(Carbon::now('Asia/Calcutta'));

                        if ($purchase->membership->duration < $days) {
                            array_push($users, $purchase->client_id);
                        }
                    }
                }
                $clients = GymClient::select('first_name', 'last_name', 'email', 'mobile', 'gender', 'gym_clients.id as clientID')
                    ->whereIn('id', $users)->get();

                break;

        }
        if ($type == 'birthday') {
            return Datatables::of($clients)
                ->edit_column('first_name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->edit_column('email', function ($row) {
                    return '<i class="fa fa-envelope"></i> ' . $row->email;
                })->edit_column('mobile', function ($row) {
                    return '<i class="fa fa-mobile"></i> ' . $row->mobile;
                })->edit_column('gender', function ($row) {
                    if ($row->gender == 'female') {
                        return '<i class="fa fa-female"></i> Female';
                    }
                    else {
                        return '<i class="fa fa-male"></i> Male';
                    }
                })
                ->add_column('action', function ($row) use ($type) {
                    return "<a href='javascript:;'  class='btn uppercase blue-chambray viewClient' data-id ='" . $row->clientID . "' data-type='" . $type . "' ><span class='fa fa-eye'></span> View</a>";
                }, 6)
                ->remove_column('last_name')
                ->remove_column('clientID')
                ->rawColumns([0,1,2,3,4,5,6,7,8,9])
                ->make();
        }
        else {
            return Datatables::of($clients)
                ->edit_column('first_name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->edit_column('email', function ($row) {
                    return '<i class="fa fa-envelope"></i> ' . $row->email;
                })->edit_column('mobile', function ($row) {
                    return '<i class="fa fa-mobile"></i> ' . $row->mobile;
                })->edit_column('gender', function ($row) {
                    if ($row->gender == 'female') {
                        return '<i class="fa fa-female"></i> Female';
                    }
                    else {
                        return '<i class="fa fa-male"></i> Male';
                    }
                })
                ->add_column('action', function ($row) use ($type) {
                    return "<a href='javascript:;'  class='btn uppercase blue-chambray viewClient' data-id ='" . $row->clientID . "' data-type='" . $type . "' ><span class='fa fa-eye'></span> View</a>";
                }, 5)
                ->remove_column('last_name')
                ->remove_column('clientID')
                ->rawColumns([0,1,2,3,4,5,6,7,8,9])
                ->make();
        }

    }

    public function show($id) {
        $purchases = GymPurchase::where('client_id', '=', $id)->where('detail_id', '=', $this->data['user']->detail_id)->get();
        $memberships = array();
        foreach ($purchases as $purchase) {
            if ($purchase->membership_id != null) {
                array_push($memberships, $purchase->membership->title);
            }
        }

        $this->data['memberships'] = $memberships;
        return View::make('gym-admin.reports.client.show', $this->data);
    }
}
