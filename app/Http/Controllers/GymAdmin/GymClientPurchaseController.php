<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Http\Requests\GymAdmin\Subscriptions\AmountRequest;
use App\Http\Requests\GymAdmin\Subscriptions\ReminderRequest;
use App\Http\Requests\GymAdmin\Subscriptions\RenewSubsriptionRequest;
use App\Http\Requests\GymAdmin\Subscriptions\StoreRequest;
use App\Http\Requests\GymAdmin\Subscriptions\UpdateRequest;
use App\Mail\ClientSubscriptionNotification;
use App\Models\BusinessCategory;
use App\Models\GymClient;
use App\Models\GymClientReminderHistory;
use App\Models\GymMembership;
use App\Models\GymPackage;
use App\Models\GymPurchase;
use App\Notifications\AddSubscriptionNotification;
use App\Notifications\RenewSubscriptionNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;

class GymClientPurchaseController extends GymAdminBaseController
{
    public function __construct() {
        parent::__construct();

    }

    public function index() {
        if (!$this->data['user']->can("view_subscriptions")) {
            return App::abort(401);
        }

        $this->data['manageMenu'] = 'active';
        $this->data['subscriptionMenu'] = 'active';
        $this->data['pendingCount'] = GymPurchase::where('detail_id', '=', $this->data['user']->detail_id)
            ->where('status', '=', 'pending')
            ->count();

        if (Session::has('user_id')) {
            Session::forget('user_id');
        }

        $this->data['title'] = "Client Purchase";
        return View::make('gym-admin.purchase.index', $this->data);
    }

    public function create() {
        if (!$this->data['user']->can("add_subscriptions")) {
            return App::abort(401);
        }

        $this->data['manageMenu'] = 'active';
        $this->data['subscriptionMenu'] = 'active';

        $this->data['clients'] = GymClient::join('business_customers', 'business_customers.customer_id', '=','gym_clients.id')
            ->where('business_customers.detail_id', '=', $this->data['user']->detail_id)
            ->select('gym_clients.id', 'gym_clients.first_name', 'gym_clients.last_name', 'business_customers.customer_id')
            ->get();

        $this->data['title'] = "New Purchase";
        $this->data['user_id'] = 0;
        $business = BusinessCategory::select('categories.name', 'categories.id as id')
            ->leftJoin('categories', 'categories.id', '=', 'business_categories.category_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->get();
        $memberships = GymMembership::select('id', 'title', 'business_category_id as cat_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->get();
        $gymMembership = array();

        foreach ($memberships as $key => $membership) {
            foreach ($business as $b) {
                if ($membership->cat_id == $b->id) {
                    $gymMembership[$b->name][$key] = $membership;
                }
            }
        }

        $this->data['memberships'] = $gymMembership;

        return View::make('gym-admin.purchase.create', $this->data);
    }

    public function userCreate($id) {
        if (!$this->data['user']->can("add_subscriptions")) {
            return App::abort(401);
        }

        $this->data['manageMenu'] = 'active';
        $this->data['subscriptionMenu'] = 'active';

        $this->data['client'] = GymClient::join('business_customers', 'business_customers.customer_id', '=','gym_clients.id')
            ->where('business_customers.detail_id', '=', $this->data['user']->detail_id)
            ->find($id);

        if (is_null($this->data['client'])) {
            return App::abort(401);
        }

        $this->data['clients'] = GymClient::join('business_customers', 'business_customers.customer_id', '=','gym_clients.id')
            ->where('business_customers.detail_id', '=', $this->data['user']->detail_id)
            ->get();

        $this->data['title'] = "New Purchase";
        $this->data['user_id'] = $id;
        $business = BusinessCategory::select('categories.name', 'categories.id as id')
            ->leftJoin('categories', 'categories.id', '=', 'business_categories.category_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->get();
        $memberships = GymMembership::select('id', 'title', 'business_category_id as cat_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->get();
        $gymMembership = array();

        foreach ($memberships as $key => $membership) {
            foreach ($business as $b) {
                if ($membership->cat_id == $b->id) {
                    $gymMembership[$b->name][$key] = $membership;
                }
            }
        }

        $this->data['memberships'] = $gymMembership;

        return View::make('gym-admin.purchase.create', $this->data);
    }

    public function store(StoreRequest $request) {
        if (!$this->data['user']->can("add_subscriptions")) {
            return App::abort(401);
        }

        $purchase = new GymPurchase();
        $purchase->client_id = $request->get('user_id');
        $purchase->purchase_amount = $request->get('purchase_amount');
        $purchase->amount_to_be_paid = $request->get('amount_to_be_paid');
        if(is_null($request->get('discount'))) {
            $purchase->discount = 0;
        } else {
            $purchase->discount = $request->get('discount');
        }

        if ($request->get('membership_id') == '') {
            return Reply::error("Please Select Membership ");
        }

        $purchase->membership_id = $request->get('membership_id');
        $purchase->purchase_date = Carbon::createFromFormat('m/d/Y', $request->get('purchase_date'));
        $purchase->start_date = Carbon::createFromFormat('m/d/Y', $request->get('start_date'));
        $purchase->detail_id = $this->data['user']->detail_id;
        $purchase->payment_required = 'yes';

        $purchase->next_payment_date = null;

        $purchase->remarks = $request->get('remark');
        $purchase->save();

        //Set expire date
        $membershipMonths = $purchase->membership->duration;
        if ($membershipMonths == 7) {
            $expireDate = $purchase->start_date->addDays($membershipMonths);
        }
        else {
            $expireDate = $purchase->start_date->addMonths($membershipMonths);
        }
        $purchase->expires_on = $expireDate;
        $purchase->save();


        // Update joining date if first purchase
        $clientTotalPurchase = GymPurchase::clientPurchases($purchase->client_id);

        if (count($clientTotalPurchase) == 1) {
            $client = GymClient::find($purchase->client_id);
            $client->joining_date = $purchase->start_date;
            $client->save();
        }

        $user = GymClient::find($request->get('user_id'));
        $user->notify(new AddSubscriptionNotification($purchase));

        return Reply::redirect(route('gym-admin.client-purchase.index'), 'Purchase Added Successfully');
    }

    public function ajax_create() {
        if (!$this->data['user']->can("view_subscriptions")) {
            return App::abort(401);
        }

        $purchase = GymPurchase::select('first_name', 'last_name', 'amount_to_be_paid', 'paid_amount', 'gym_memberships.title as membership', 'start_date as date', 'next_payment_date', 'expires_on', 'gym_client_purchases.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.detail_id', '=', $this->data['user']->detail_id)
            ->where('gym_client_purchases.status', '=', 'active')
            ->orderBy('gym_client_purchases.id', 'desc');

        return Datatables::of($purchase)
            ->edit_column('first_name', function ($row) {
                return ucwords($row->first_name . ' ' . $row->last_name);
            }, 0)
            ->edit_column('amount_to_be_paid', function ($row) {
                return "<i class='fa ".$this->data['gymSettings']->currency->symbol."'></i>" . $row->amount_to_be_paid;
            }, 3)
            ->add_column('remaining', function ($row) {
                return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' . ($row->amount_to_be_paid - $row->paid_amount);
            }, 4)
            ->add_column('action', function ($row) {
                return '<div class="btn-group">
                    <button class="btn blue btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-gears"></i> <span class="hidden-xs">Actions</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="' . route('gym-admin.client-purchase.show', $row->id) . '"> <i class="fa fa-edit"></i>Edit</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-id="' . $row->id . '" class="remove-purchase"> <i class="fa fa-trash"></i>Remove </a>
                        </li>
                        <li>
                            <a class="add-payment" data-id="' . $row->id . '"  href="javascript:;"><i class="fa fa-plus"></i> Add Payment </a>
                        </li>
                        <li>
                            <a class="renew-subscription" data-id="' . $row->id . '"  href="javascript:;"><i class="icon-refresh"></i>  Renew Subscription</a>
                        </li>
                        <li>
                            <a class="show-subscription-reminder" data-id="' . $row->id . '"  href="javascript:;"><i class="fa fa-send"></i>  Send Renew Reminder</a>
                        </li>
                    </ul>
                </div>';
            })
            ->edit_column('date', function ($row) {
                return Carbon::createFromFormat('Y-m-d', $row->date)->toFormattedDateString();
            })
            ->edit_column('next_payment_date', function ($row) {
                if (!is_null($row->next_payment_date)) {
                    if (Carbon::now('Asia/Calcutta')->diffInDays($row->next_payment_date, false) <= 0) {
                        return $row->next_payment_date->toFormattedDateString() . ' <label class="label label-danger">Due</label>';
                    }
                    else {
                        return $row->next_payment_date->toFormattedDateString();
                    }
                }
                else if ($row->amount_to_be_paid <= $row->paid_amount) {
                    return '<label class="label label-success">Payment Complete</label>';
                }
                else {
                    return '<label class="label label-warning">No Payment Received</label>';
                }
            })
            ->edit_column('expires_on', function ($row) {
                if(!is_null($row->expires_on)) {
                    return $row->expires_on->toFormattedDateString();
                } else {
                    return '-';
                }

            })
            ->remove_column('last_name')
            ->remove_column('membership')
            ->remove_column('package')
            ->remove_column('id')
            ->remove_column('paid_amount')
            ->rawColumns([1,2,3,4,5,6,7,8])
            ->make();
    }

    public function show($id) {
        if (!$this->data['user']->can("edit_subscriptions")) {
            return App::abort(401);
        }

        $this->data['manageMenu'] = 'active';
        $this->data['subscriptionMenu'] = 'active';
        $this->data['title'] = "Edit Purchase";
        $this->data['packages'] = GymPackage::where('detail_id', '=', $this->data['user']->detail_id)->get();
        $this->data['purchase'] = GymPurchase::with('membership')->find($id);

        $this->data['purchaseTitle'] = $this->data['purchase']->membership->title;

        $business = BusinessCategory::select('categories.name', 'business_categories.id as id')
            ->leftJoin('categories', 'categories.id', '=', 'business_categories.category_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->get();
        $memberships = GymMembership::select('id', 'title', 'business_category_id as cat_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->get();
        $gymMembership = array();

        foreach ($memberships as $key => $membership) {
            foreach ($business as $b) {
                if ($membership->cat_id == $b->id) {
                    $gymMembership[$b->name][$key] = $membership;
                }
            }
        }

        $this->data['memberships'] = $gymMembership;

        return View::make('gym-admin.purchase.edit', $this->data);
    }

    public function update(UpdateRequest $request, $id) {
        if (!$this->data['user']->can("edit_subscriptions")) {
            return App::abort(401);
        }

        $purchase = GymPurchase::find($id);

        $purchase->purchase_amount = $request->get('purchase_amount');
        $purchase->amount_to_be_paid = $request->get('amount_to_be_paid');
        $purchase->discount = $request->get('discount');

        $purchase->purchase_date = Carbon::createFromFormat('m/d/Y', $request->get('purchase_date'));
        $purchase->start_date = Carbon::createFromFormat('m/d/Y', $request->get('start_date'));
        $purchase->detail_id = $this->data['user']->detail_id;
        $purchase->payment_required = $request->get('payment_required');

        if ($purchase->payment_required == 'yes') {
            $purchase->next_payment_date = Carbon::createFromFormat('m/d/Y', $request->get('next_payment_date'));
        }

        $purchase->remarks = $request->get('remark');

        if($request->status == 'on') {
            $purchase->status = 'active';
        } else {
            $purchase->status = 'pending';
        }

        $purchase->save();

        //Update expire date
        $membershipMonths = $purchase->membership->duration;

        if ($membershipMonths == 7) {
            $expireDate = $purchase->start_date->addDays($membershipMonths);
        }
        else {
            $expireDate = $purchase->start_date->addMonths($membershipMonths);
        }

        $purchase->expires_on = $expireDate;
        $purchase->save();

        $user = GymClient::find($purchase->client_id);
        $user->notify(new AddSubscriptionNotification($purchase));

        $eText = "Admin approved your Subscription";

        $this->data['title'] = "Subscription Approved";
        $this->data['mailHeading'] = "Subscription Approve Notification";
        $this->data['emailText'] = $eText;
        $this->data['url'] = '';

        Mail::to($purchase->client->email)->send(new ClientSubscriptionNotification($this->data));

        return Reply::redirect(route('gym-admin.client-purchase.index'), 'Subscription updated successfully.');
    }

    public function destroy($id, Request $request) {
        if (!$this->data['user']->can("delete_subscriptions")) {
            return App::abort(401);
        }

        if ($request->ajax()) {
            GymPurchase::find($id)->delete();
            return Reply::success('Subscription removed successfully');
        }

        return Reply::error('Request not Valid');
    }

    public function getAmount(AmountRequest $request) {
        $type = $request->get('type');
        $id = $request->get('id');
        $amount = 0;
        $discount = 0;
        $paid = 0;

        switch ($type) {
            case 'membership':
                $amount = GymMembership::where('id', '=', $id)->first()->price;
                $discount = 0;
                $paid = $amount;
                break;
        }

        $data = ['amount' => $amount, 'discount' => $discount, 'paid' => $paid];

        return Reply::successWithData('Amount Fetched', $data);
    }

    public function reminder() {
        if (!$this->data['user']->can("view_due_payments")) {
            return App::abort(401);
        }

        $this->data['account'] = 'active';
        $this->data['paymentMenu'] = 'active';
        $this->data['paymentreminderMenu'] = 'active';

        $this->data['title'] = 'Payments Reminder';
        return View::make('gym-admin.payments.reminder', $this->data);
    }

    public function ajax_reminder() {
        if (!$this->data['user']->can("view_due_payments")) {
            return App::abort(401);
        }

        $dt = Carbon::now('Asia/Calcutta');
        $date = $dt->format('Y-m-d');
        $purchase = GymPurchase::select('first_name', 'last_name', 'gym_client_purchases.amount_to_be_paid as amount_to_be_paid', 'gym_client_purchases.purchase_amount as purchase_amount', 'gym_client_purchases.paid_amount as paid', 'gym_client_purchases.discount as discount', 'next_payment_date as due_date', 'gym_memberships.title as membership', 'gym_client_purchases.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.detail_id', '=', $this->data['user']->detail_id)
            ->where('gym_client_purchases.next_payment_date', '<=', $date)
            ->where('gym_client_purchases.next_payment_date', '!=', '0000-00-00');


        return Datatables::of($purchase)
            ->edit_column('first_name', function ($row) {
                return $row->first_name . ' ' . $row->last_name;
            })
            ->edit_column('purchase_amount', function ($row) {
                return $row->amount_to_be_paid - $row->paid;
            })
            ->edit_column('discount', function ($row) {
                return $row->discount;
            })
            ->edit_column('due_date', function ($row) {
                return Carbon::createFromFormat('Y-m-d', $row->due_date)->toFormattedDateString();
            })
            ->add_column('action', function ($row) {
                return "<div class=\"btn-group\">
                            <button class=\"btn btn-xs blue dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-expanded=\"true\"><span class=\"hidden-xs\">ACTION</span>
                                <i class=\"fa fa-angle-down\"></i>
                            </button>
                            <ul class=\"dropdown-menu  pull-right\" role=\"menu\">
                                <li>
                                    <a  data-id=\"$row->id\" class=\"show-reminder\"><i class=\"fa fa-send\"></i> Send Reminder
                  </a>
                                </li>
                                <li>
                                    <a class=\"add-payment\" data-id=\"$row->id\"  href=\"javascript:;\"><i class=\"fa fa-plus\"></i> Add Payment </a>
                                </li>


                         </ul>
                        </div>";
            })
            ->remove_column('paid')
            ->remove_column('last_name')
            ->remove_column('membership')
            ->remove_column('package')
            ->remove_column('id')
            ->rawColumns([5,6,7])
            ->make();
    }

    public function showModel($id) {
        $payment_details = GymPurchase::select('first_name', 'last_name', 'email', 'mobile', 'gym_memberships.title as membership', 'paid_amount', 'amount_to_be_paid')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.id', '=', $id)
            ->first();

        $this->data['client_data'] = $payment_details;
        $this->data['id'] = $id;
        return View::make('gym-admin.payments.sendreminder', $this->data);
    }

    public function sendReminder(ReminderRequest $request) {
        $email = $request->get('email');
        $mobile = $request->get('mobile');
        $payment = $request->get('payment');
        $membership = $request->get('membership');
        $offer = $request->get('offer');
        $purchaseId = $request->get('purchaseId');

        if ($membership != '') {
            $type = $membership;
        }
        else {
            $type = $offer;
        }

        $text = 'Dear Customer, your payment of Rs' . $payment . ' is due. Please deposit asap. - ' . ucwords($this->data['merchantBusiness']->business->title);
        $eText = $text;
        $eTitle = "Payment Reminder for " . $type;
        $eHeading = 'Payment Reminder';

        // For Mail and SMS
        $this->emailNotification($email, $eText, $eTitle, $eHeading);
        $this->smsNotification([$mobile], $text);

        $purchase = GymPurchase::find($purchaseId);

        // Create log
        $history = [
            'client_id' => $purchase->client_id,
            'purchase_id' => $purchaseId,
            'detail_id' => $this->data['merchantBusiness']->business->id,
            'reminder_text' => $text,
            'mobile' => $mobile,
            'email' => $email
        ];

        GymClientReminderHistory::create($history);

        return Reply::success('Reminder sent successfully');
    }

    public function reminderHistory() {
        if (!$this->data['user']->can("view_due_payments")) {
            return App::abort(401);
        }

        $this->data['account'] = 'active';
        $this->data['paymentMenu'] = 'active';
        $this->data['title'] = 'Reminder History';
        $this->data['paymentreminderHistoryMenu'] = 'active';

        return view('gym-admin.payments.reminder_history', $this->data);
    }

    public function ajaxReminderHistory() {
        if (!$this->data['user']->can("view_due_payments")) {
            return App::abort(401);
        }

        $history = GymClientReminderHistory::where('detail_id', $this->data['merchantBusiness']->business->id);

        return Datatables::of($history)
            ->edit_column('client_id', function ($row) {
                return ucwords($row->client->first_name . ' ' . $row->client->last_name);
            })
            ->edit_column('created_at', function ($row) {
                return $row->created_at->format('d F, Y');
            })
            ->remove_column('detail_id')
            ->remove_column('purchase_id')
            ->remove_column('updated_at')
            ->remove_column('id')
            ->make();
    }

    /**
     * Show modal to renew subscription
     * */
    public function renewSubscriptionModal($id) {
        $this->data['purchase'] = GymPurchase::find($id);
        return view('gym-admin.purchase.renew_subscription_modal', $this->data);
    }

    /**
     * Save renew subscription data
     * */

    public function renewSubscriptionStore(RenewSubsriptionRequest $request, $id) {

        $purchase = GymPurchase::find($id);

        $renew = new GymPurchase();
        $renew->client_id = $purchase->client_id;
        $renew->purchase_amount = $request->get('purchase_amount');
        $renew->amount_to_be_paid = $request->get('amount_to_be_paid');
        $renew->discount = $request->get('discount');
        $renew->membership_id = $purchase->membership_id;

        $renew->purchase_date = Carbon::createFromFormat('m/d/Y', $request->get('purchase_date'));
        $renew->start_date = Carbon::createFromFormat('m/d/Y', $request->get('start_date'));
        $renew->detail_id = $this->data['user']->detail_id;
        $renew->payment_required = 'yes';

        $renew->next_payment_date = null;

        $renew->remarks = $request->get('remark');
        $renew->save();

        //set expire date;
        $membershipMonths = $renew->membership->duration;
        $expireDate = $renew->start_date->addMonths($membershipMonths);
        $renew->expires_on = $expireDate;
        $renew->save();

        // Update joining date if first purchase
        $clientTotalPurchase = GymPurchase::clientPurchases($renew->client_id);

        if (count($clientTotalPurchase) == 1) {
            $client = GymClient::find($renew->client_id);
            $client->joining_date = $renew->start_date;
            $client->save();
        }

        Notification::send(GymClient::find($purchase->client_id), new RenewSubscriptionNotification($renew));

        return Reply::success('Subscription Renewed Successfully');
    }

    public function subscriptionReminderModal($id) {
        $payment_details = GymPurchase::select('first_name', 'last_name', 'email', 'mobile', 'gym_memberships.title as membership', 'gym_client_purchases.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.id', '=', $id)
            ->first();

        $this->data['client_data'] = $payment_details;
        $this->data['id'] = $id;
        return View::make('gym-admin.purchase.sendreminder', $this->data);
    }

    public function sendRenewReminder(Request $request) {


        $email = $request->get('email');
        $mobile = $request->get('mobile');
        $membership = $request->get('membership');
        $offer = $request->get('offer');
        $purchaseId = $request->get('purchaseId');

        $purchase = GymPurchase::find($purchaseId);

        if ($membership != '') {
            $type = $membership;
        }
        else {
            $type = $offer;
        }

        $text = 'Dear Customer, your subscription of ' . $membership . ' is expiring on '.(isset($purchase->expires_on))?$purchase->expires_on->format('d M, Y'):'-'.'. Please renew asap. - ' . ucwords($this->data['merchantBusiness']->business->title);
        $eText = $text;
        $eTitle = "Subscription Renewal Reminder for " . $type;
        $eHeading = 'Subscription Renewal Reminder';

        // For Mail and SMS
        if($request->get('emailReminder') == 1){
            $this->emailNotification($email, $eText, $eTitle, $eHeading);
        }

        if($request->get('smsReminder') == 1) {
            $this->smsNotification([$mobile], $text);
        }

        // Create log
        $history = [
            'client_id' => $purchase->client_id,
            'purchase_id' => $purchaseId,
            'detail_id' => $this->data['merchantBusiness']->business->id,
            'reminder_text' => $text,
            'mobile' => $mobile,
            'email' => $email
        ];

        GymClientReminderHistory::create($history);

        return Reply::success('Reminder sent successfully');
    }

    public function pendingSubscription()
    {
        $this->data['manageMenu'] = 'active';
        $this->data['subscriptionMenu'] = 'active';
        $this->data['title'] = "Client Purchase";

        return view('gym-admin.purchase.pending-subscription', $this->data);
    }

    public function ajaxPendingSubscription()
    {
        $purchase = GymPurchase::select('first_name', 'last_name', 'amount_to_be_paid', 'paid_amount', 'gym_memberships.title as membership', 'start_date as date', 'next_payment_date', 'expires_on', 'gym_client_purchases.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.detail_id', '=', $this->data['user']->detail_id)
            ->where('gym_client_purchases.status', '=', 'pending')
            ->orderBy('gym_client_purchases.id', 'desc');

        return Datatables::of($purchase)
            ->edit_column('first_name', function ($row) {
                return ucwords($row->first_name . ' ' . $row->last_name);
            }, 0)
            ->edit_column('amount_to_be_paid', function ($row) {
                return "<i class='fa ".$this->data['gymSettings']->currency->symbol."'></i>" . $row->amount_to_be_paid;
            }, 3)
            ->add_column('remaining', function ($row) {
                return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' . ($row->amount_to_be_paid - $row->paid_amount);
            }, 4)
            ->add_column('action', function ($row) {
                return '<div class="btn-group">
                    <button class="btn blue btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-gears"></i> <span class="hidden-xs">Actions</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="' . route('gym-admin.client-purchase.show', $row->id) . '"> <i class="fa fa-edit"></i>Edit</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-id="' . $row->id . '" class="remove-purchase"> <i class="fa fa-trash"></i>Remove </a>
                        </li>
                    </ul>
                </div>';
            })
            ->edit_column('date', function ($row) {
                return Carbon::createFromFormat('Y-m-d', $row->date)->toFormattedDateString();
            })
            ->edit_column('next_payment_date', function ($row) {
                if (!is_null($row->next_payment_date)) {
                    if (Carbon::now('Asia/Calcutta')->diffInDays($row->next_payment_date, false) <= 0) {
                        return $row->next_payment_date->toFormattedDateString() . ' <label class="label label-danger">Due</label>';
                    }
                    else {
                        return $row->next_payment_date->toFormattedDateString();
                    }
                }
                else if ($row->amount_to_be_paid <= $row->paid_amount) {
                    return '<label class="label label-success">Payment Complete</label>';
                }
                else {
                    return '<label class="label label-warning">No Payment Received</label>';
                }
            })
            ->edit_column('expires_on', function ($row) {
                if(!is_null($row->expires_on)) {
                    return $row->expires_on->toFormattedDateString();
                } else {
                    return '-';
                }

            })
            ->remove_column('last_name')
            ->remove_column('membership')
            ->remove_column('package')
            ->remove_column('id')
            ->remove_column('paid_amount')
            ->rawColumns([0,1])
            ->make(true);
    }

}
