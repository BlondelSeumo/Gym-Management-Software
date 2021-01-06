<?php

namespace App\Http\Controllers\GymAdmin;

use App\Models\GymClient;
use App\Models\GymPurchase;
use App\Models\BusinessEnquiry;
use App\Models\GymClientAttendance;
use App\Models\GymMembership;
use App\Models\GymMembershipPayment;
use App\Models\BusinessSubCategory;
use App\Helper\Reply;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;

class GymAdminbackupController extends GymAdminBaseController
{
    public function index()
    {

        if(!$this->data['user']->can("download_backup"))
        {
            return App::abort(401);
        }

        $this->data['title'] = "Take Backup";
        return View::make('gym-admin.backup.backup', $this->data);
    }


    public function getbackup($type)
    {

        if ($type == 'customer')
        {
            $users = GymClient::select(DB::raw("first_name as 'First Name', last_name as 'Last Name'"),DB::raw("DATE_FORMAT(dob, '%d-%M-%y ') as Birthday "),'gender as Gender','email as Email','mobile as Mobile',
                DB::raw("DATE_FORMAT(joining_date, '%d-%M-%y ') as 'Joining Date' "),'client_source as Source'
                ,'weight as Weight',DB::raw("marital_status as 'Marital Status'"),'address as Address','height_feet as Height',DB::raw("DATE_FORMAT(anniversary, '%d-%M-%y ') as Anniversary "))
                ->join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
                    ->where('business_customers.detail_id', '=', $this->data['merchantBusiness']->detail_id)
                ->where('business_customers.detail_id','=',$this->data['user']->detail_id)
                ->limit(1)
                ->get()->toArray();


            \Excel::create('customer', function($excel) use($users) {
                $excel->sheet('Sheet 1', function($sheet) use($users) {
                    $sheet->cell('A1:N1', function($cells) {
                        $cells->setFontWeight('bold');
                    });

                    $sheet->fromArray($users);

                });
            })->export('xls');
        }

        elseif ($type == 'subscriptions')
        {
            $subscription = GymPurchase::select(Db::raw("first_name as 'First Name',
                last_name as 'Last Name',
                purchase_amount as 'Purchase Amount',
                amount_to_be_paid as 'Amount To Be Paid'")
                ,
                'discount as Discount',
                'gym_memberships.title as Membership',
                DB::raw("DATE_FORMAT(purchase_date, '%d-%M-%y ') as Date "))
                ->leftJoin('gym_clients','gym_clients.id','=','client_id')
                ->leftJoin('gym_memberships','gym_memberships.id','=','membership_id')
                ->where('gym_client_purchases.detail_id','=',$this->data['user']->detail_id)
                ->get()->toArray();
            \Excel::create('Subscriptions', function($excel) use($subscription) {
                $excel->sheet('Sheet 1', function($sheet) use($subscription) {
                    $sheet->cell('A1:I1', function($cells) {
                        $cells->setFontWeight('bold');
                    });
                    $sheet->fromArray($subscription);
                });
            })->export('xls');
        }

        elseif ($type == 'membership')
        {
            $membership = GymMembership::select('title AS Title','price as Price','duration as Duration','details as Details')->
                          where('detail_id','=',$this->data['user']->detail_id)
                          ->get()->toArray();
            \Excel::create('membership', function($excel) use($membership) {
                $excel->sheet('Sheet 1', function($sheet) use($membership) {
                    $sheet->cell('A1:D1', function($cells) {
                        $cells->setFontWeight('bold');
                    });
                    $sheet->fromArray($membership);
                });
            })->export('xls');
        }

        elseif ($type == 'attendance')
        {
            \Excel::create('attendance', function($excel)  {
                for($i= Carbon::now('Asia/Calcutta')->startOfMonth()->format('Y-m-d');$i<=Carbon::now('Asia/Calcutta')->format('Y-m-d');$i++)
                {
                    $attendance = GymClientAttendance::select(DB::raw("gym_clients.first_name as 'First Name',
                        gym_clients.last_name as 'Last Name'"),'gym_clients.mobile as Mobile','gym_clients.email as Email'
                        , DB::raw("DATE_FORMAT(check_in, '%d-%M-%y %h:%i %a ') as CheckIn "))
                        ->rightJoin('gym_clients','gym_clients.id','=','gym_client_attendances.client_id')
                        ->leftJoin('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
                        ->where('business_customers.detail_id','=',$this->data['user']->detail_id)

                        ->whereDate('check_in','=',$i)
                        ->orderBy('check_in','desc')
                        ->get()->toArray();
                    $excel->sheet($i, function($sheet) use($attendance) {
                        $sheet->cell('A1:E1', function($cells) {
                            $cells->setFontWeight('bold');
                        });
                        $sheet->fromArray($attendance);
                    });
                }
            })->export('xls');

        }
        elseif ($type == 'enquiries')
        {
            $enquiry = BusinessEnquiry::select(Db::raw("username as 'User Name',phone as 'Phone',query as 'Query',status as 'Status',enquire_mode as 'Enquiry Mode'"))
                ->where('detail_id','=',$this->data['user']->detail_id)
                ->get()->toArray();
            \Excel::create('enquiry', function($excel) use($enquiry) {
                $excel->sheet('Sheet 1', function($sheet) use($enquiry) {
                    $sheet->cell('A1:E1', function($cells) {
                        $cells->setFontWeight('bold');
                    });
                    $sheet->fromArray($enquiry);
                });
            })->export('xls');
        }

        elseif ($type == 'payments')
        {
            $payments = GymMembershipPayment::select(DB::raw(" gym_clients.first_name as 'First Name',gym_clients.last_name as 'Last Name',payment_amount as 'Payment Amount',payment_source as 'Payment Source'"),
                DB::raw('CONCAT(gym_memberships.title, " ", "[" ,categories.name ,"]") AS membership'),
                DB::raw("DATE_FORMAT(payment_date, '%d-%M-%y %h:%i %a ') as 'Payment Date' "),
                DB::raw("merchant_custom_payment_type.name as 'Payment Type'"))
                ->leftJoin('gym_client_purchases','gym_client_purchases.id','=','gym_membership_payments.purchase_id')
                ->leftJoin('merchant_custom_payment_type','gym_membership_payments.payment_type','=','merchant_custom_payment_type.id')
                ->leftJoin('gym_clients','gym_clients.id','=','gym_membership_payments.user_id')
                ->leftJoin('gym_memberships','gym_memberships.id','=','gym_client_purchases.membership_id')
                ->leftJoin('business_categories','gym_memberships.business_category_id','=','business_categories.category_id')
                ->leftJoin('categories','business_categories.category_id','=','categories.id')
                ->where('gym_membership_payments.detail_id','=',$this->data['user']->detail_id)
                ->get()->toArray();


            \Excel::create('payments', function($excel) use($payments) {
                $excel->sheet('Sheet 1', function($sheet) use($payments) {
                    $sheet->cell('A1:K1', function($cells) {
                        $cells->setFontWeight('bold');
                    });
                    $sheet->fromArray($payments);
                });
            })->export('xls');
        }
    }
}
