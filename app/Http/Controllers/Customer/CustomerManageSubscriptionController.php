<?php

namespace App\Http\Controllers\Customer;

use App\Classes\Reply;
use App\Http\Requests\CustomerApp\ManageSubscription\StoreSubscriptionRequest;
use App\Mail\AdminSubscriptionNotification;
use App\Models\GymClient;
use App\Models\GymMembership;
use App\Models\GymMerchantRole;
use App\Models\GymPurchase;
use App\Models\MerchantNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;

class CustomerManageSubscriptionController extends CustomerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Fitsigma | Subscription';
        $this->data['subscriptionMenu'] = 'active';

        return view('customer-app.manage-subscription.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['businesses'] = GymClient::leftJoin('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->leftJoin('common_details', 'common_details.id','=', 'business_customers.detail_id')
            ->where('business_customers.customer_id', '=', $this->data['customerValues']->id)
            ->select('common_details.id as id', 'common_details.title')
            ->get();

        return view('customer-app.manage-subscription.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionRequest $request)
    {
        $purchase = new GymPurchase();
        $purchase->client_id = $this->data['customerValues']->id;
        $purchase->membership_id = $request->membership_id;
        $purchase->detail_id = $request->branch_id;
        $purchase->purchase_amount = $request->cost;
        $purchase->amount_to_be_paid = $request->cost;
        $purchase->paid_amount = 0;
        $purchase->discount = 0;
        $purchase->start_date = Carbon::createFromFormat('m/d/Y', $request->joining_date)->format('Y-m-d');
        $purchase->status = 'pending';
        $purchase->payment_required = 'yes';
        $purchase->purchase_date = Carbon::now()->format('Y-m-d');
        $purchase->save();

        //region Notification
        $notification = new MerchantNotification();
        $notification->detail_id = $request->branch_id;
        $notification->notification_type = 'Subscription';
        $notification->title = 'New subscription is added by customer';
        $notification->save();
        //endregion

        $admins = GymMerchantRole::select('merchants.email as email')
            ->join('gym_merchant_role_users', 'gym_merchant_role_users.role_id', '=', 'gym_merchant_roles.id')
            ->join('merchants', 'merchants.id', '=', 'gym_merchant_role_users.user_id')
            ->join('gym_merchant_role_permissions', 'gym_merchant_role_permissions.role_id', '=', 'gym_merchant_role_users.role_id')
            ->join('gym_merchant_permissions', 'gym_merchant_permissions.id', '=', 'gym_merchant_role_permissions.permission_id')
            ->where('gym_merchant_roles.detail_id', '=', $this->data['customerValues']->detail_id)
            ->where('gym_merchant_permissions.name', '=', 'message')
            ->get();

        $eText = "".$this->data['customerValues']->first_name.' '.$this->data['customerValues']->last_name."added a Subscription";

        $this->data['title'] = "Subscription Notification";
        $this->data['mailHeading'] = "Subscription Notification";
        $this->data['emailText'] = $eText;
        $this->data['url'] = '';

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new AdminSubscriptionNotification($this->data));
        }

        return Reply::redirect(route('customer-app.manage-subscription.index'), 'Subscription is added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['showSubscription'] = GymPurchase::find($id);

        return view('customer-app.manage-subscription.view-modal', $this->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GymPurchase::destroy($id);

        return Reply::success('Subscription is deleted successfully');
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $purchase = GymPurchase::select('amount_to_be_paid', 'paid_amount', 'gym_memberships.title as membership', 'start_date as date', 'next_payment_date', 'expires_on', 'gym_client_purchases.id', 'gym_client_purchases.status')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('client_id', $this->data['customerValues']->id)
            ->orderBy('gym_client_purchases.id', 'desc');

        return Datatables::of($purchase)
            ->edit_column('membership', function ($row) {
                return ucwords($row->membership);
            })
            ->edit_column('payments', function ($row) {

                if (!is_null($row->next_payment_date)) {
                    if (Carbon::now('Asia/Calcutta')->diffInDays($row->next_payment_date, false) <= 0) {
                        $paymentDate =  $row->next_payment_date->toFormattedDateString() . ' <label class="label label-danger">Due</label>';
                    }
                    else {
                        $paymentDate = $row->next_payment_date->toFormattedDateString();
                    }
                }
                else if ($row->amount_to_be_paid <= $row->paid_amount) {
                    $paymentDate = '<label class="label label-success">Payment Complete</label>';
                }
                else {
                    $paymentDate = '<label class="label label-warning">No Payment Received</label>';
                }

                $str = '<ul>
                            <li>Amount To Be Paid: <i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i> '.$row->amount_to_be_paid.'</li>
                            <li>Remaining Amount: <i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i> '.($row->amount_to_be_paid - $row->paid_amount).'</li>
                            <li>Next Payment: '.$paymentDate.'</li>
                        </ul>';

                return $str;
            })
            ->add_column('action', function ($row) {
                if($row->status == 'active') {
                    return '<button class="btn btn-sm btn-info waves-effect view-subscription" data-pk="'.$row->id.'">View</button>';
                } else {
                    return '<button class="btn btn-sm btn-danger waves-effect delete-subscription" data-pk="'.$row->id.'">Delete</button>';
                }
            })
            ->edit_column('date', function ($row) {
                return Carbon::createFromFormat('Y-m-d', $row->date)->toFormattedDateString();
            })
            ->edit_column('expires_on', function ($row) {
                if(!is_null($row->expires_on)) {
                    return $row->expires_on->toFormattedDateString();
                } else {
                    return '-';
                }

            })
            ->edit_column('status', function($row) {
                if($row->status == 'active') {
                    return '<label class="label label-success">'.ucwords($row->status).'</label>';
                } else {
                    return '<label class="label label-danger">'.ucwords($row->status).'</label>';
                }
            })
            ->remove_column('id')
            ->remove_column('paid_amount')
            ->remove_column('next_payment_date')
            ->rawColumns([0,1,2,3,4,5,6,7,8])
            ->make(true);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getMembership(Request $request)
    {
        $memberships = GymMembership::where('detail_id', '=', $request->branch_id)
            ->get();

        $output = [];
        foreach ($memberships as $membership) {
            array_push($output, $membership);
        }

        return json_encode($output);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getMembershipAmount(Request $request)
    {
        $price = GymMembership::find($request->membership_id);

        return json_encode($price);
    }
}
