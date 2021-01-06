<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymClient;
use App\Models\GymMembership;
use App\Models\GymMembershipPayment;
use App\Models\GymPackage;
use App\Models\GymPurchase;
use App\Models\MerchantCustomPaymentType;
use App\Notifications\AddPaymentNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;

class GymMembershipPaymentsController extends GymAdminBaseController
{
    public function __construct() {
        parent::__construct();
        $this->data['paymentMenu'] = 'active';
        $this->data['showpaymentMenu'] = 'active';
        $this->data['account'] = 'active';
    }


    /**
     * Load the index page for Membership Payments
     */
    public function index() {

        if(!$this->data['user']->can("view_payments"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Payments';
        return View::make('gym-admin.payments.index', $this->data);
    }

    public function ajax_create() {
        if(!$this->data['user']->can("view_payments"))
        {
            return App::abort(401);
        }

        $payments = GymMembershipPayment::select('gym_membership_payments.id as pid', 'gym_clients.first_name', 'gym_clients.last_name', 'payment_amount', 'gym_memberships.title as membership', 'payment_source', 'payment_date', 'payment_id', 'merchant_custom_payment_type.name as payment_type', 'purchase_id')
            ->leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'gym_membership_payments.purchase_id')
            ->leftJoin('merchant_custom_payment_type', 'gym_membership_payments.payment_type', '=', 'merchant_custom_payment_type.id')->leftJoin('gym_clients', 'gym_clients.id', '=', 'gym_membership_payments.user_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'gym_client_purchases.membership_id')
            ->where('gym_membership_payments.detail_id', '=', $this->data['user']->detail_id);


        return Datatables::of($payments)->edit_column('first_name', function ($row) {
                return ucwords($row->first_name . ' ' . $row->last_name);
            })->edit_column('payment_source', function ($row) {
                if ($row->payment_source == 'cash') {
                    return "<div class='font-dark'> Cash <i class='fa fa-money'></i> </div>";
                }
                if ($row->payment_source == 'credit_card') {
                    return "<div class='font-dark'> Credit Card <i class='fa fa-credit-card'></i> </div>";
                }
                if ($row->payment_source == 'debit_card') {
                    return "<div class='font-dark'> Debit Card <i class='fa fa-cc-visa'></i> </div>  ";
                }
                else {
                    return "<div class='font-dark'> Net Banking <i class='fa fa-internet-explorer '></i> </div>";
                }
            })->edit_column('payment_date', function ($row) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $row->payment_date)->toFormattedDateString();
            })->edit_column('payment_amount', function ($row) {
                return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' . $row->payment_amount;
            })->edit_column('payment_id', function ($row) {
                return '<b>' . $row->payment_id . '</b>';
            })->edit_column('payment_type', function ($row) {
                if (is_null($row->payment_type)) {
                    return 'Membership';
                }
                return ucfirst($row->payment_type);
            })->add_column('action', function ($row) {

                return "<div class=\"btn-group\">
                            <button class=\"btn btn-xs yellow dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-expanded=\"true\"><span class=\"hidden-xs\">ACTION</span>
                                <i class=\"fa fa-angle-down\"></i>
                            </button>
                            <ul class=\"dropdown-menu  pull-right\" role=\"menu\">
                                <li>
                                    <a href='" . route("gym-admin.gym-invoice.generate-payment-invoice", $row->pid) . "'><i class=\"fa fa-file\"></i> Generate Invoice </a>
                                </li>
                                <li>
                                    <a href='" . route("gym-admin.membership-payment.show", $row->pid) . "'><i class=\"fa fa-edit\"></i> Edit </a>
                                </li>
                                <li>
                                    <a class=\"remove-payment\" data-payment-id=\"$row->pid\"  href=\"javascript:;\"><i class=\"fa fa-trash\"></i> Delete </a>
                                </li>
                                

                         </ul>
                        </div>";


            })->remove_column('last_name')
            ->remove_column('pid')
            ->remove_column('package')
            ->remove_column('payment_frequency')
            ->remove_column('purchase_id')
            ->remove_column('membership')
            ->rawColumns([1,2,3,4,5,6])
            ->make();
    }

    public function ajax_create_deleted() {
        if(!$this->data['user']->can("view_payments"))
        {
            return App::abort(401);
        }

        $payments = GymMembershipPayment::onlyTrashed()
            ->select('gym_membership_payments.id as pid', 'gym_clients.first_name', 'gym_clients.last_name', 'payment_amount', 'gym_memberships.title as membership', 'payment_source', 'payment_date', 'payment_id', 'merchant_custom_payment_type.name as payment_type', 'purchase_id', 'gym_membership_payments.deleted_at')->leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'gym_membership_payments.purchase_id')->leftJoin('merchant_custom_payment_type', 'gym_membership_payments.payment_type', '=', 'merchant_custom_payment_type.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'gym_membership_payments.user_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'gym_client_purchases.membership_id')
            ->where('gym_membership_payments.detail_id', '=', $this->data['user']->detail_id)
            ->whereNotNull('gym_membership_payments.deleted_at');


        return Datatables::of($payments)->edit_column('first_name', function ($row) {
                return ucwords($row->first_name . ' ' . $row->last_name);
            })->edit_column('payment_source', function ($row) {
                if ($row->payment_source == 'cash') {
                    return "<div class='font-dark'> Cash <i class='fa fa-money'></i> </div>";
                }
                if ($row->payment_source == 'credit_card') {
                    return "<div class='font-dark'> Credit Card <i class='fa fa-credit-card'></i> </div>";
                }
                if ($row->payment_source == 'debit_card') {
                    return "<div class='font-dark'> Debit Card <i class='fa fa-cc-visa'></i> </div>  ";
                }
                else {
                    return "<div class='font-dark'> Net Banking <i class='fa fa-internet-explorer '></i> </div>";
                }
            })
            ->edit_column('payment_date', function ($row) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $row->payment_date)->toFormattedDateString();
            })
            ->edit_column('payment_amount', function ($row) {
                return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' . $row->payment_amount;
            })
            ->edit_column('membership', function ($row) {
                if ($row->purchase_id == null) {
                    return '';
                }
                else {
                    return ucwords($row->membership) . '<br> <span class="label label-info"> MEMBERSHIP </span>';
                }
            })->edit_column('payment_id', function ($row) {
                return '<b>' . $row->payment_id . '</b>';
            })->edit_column('payment_type', function ($row) {
                if ($row->payment_type == null) {
                    return 'Membership';
                }
                return ucfirst($row->payment_type);
            })->edit_column('deleted_at', function ($row) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $row->deleted_at)->toFormattedDateString();
            })->remove_column('last_name')
            ->remove_column('pid')
            ->remove_column('package')
            ->remove_column('payment_frequency')
            ->remove_column('purchase_id')
            ->rawColumns([1,2,3,5])
            ->make();
    }

    public function create() {
        if(!$this->data['user']->can("add_payment"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Add Payment';
        $this->data['clients'] = GymClient::GetClients($this->data['user']->detail_id);
        $this->data['memberships'] = GymMembership::membershipsForSelect($this->data['user']->detail_id);
        $this->data['packages'] = GymPackage::businessPackages($this->data['user']->detail_id);
        $this->data['p_types'] = MerchantCustomPaymentType::where('detail_id', '=', $this->data['user']->detail_id)->get();
        return View::make('gym-admin.payments.create', $this->data);
    }

    public function store() {
        if(!$this->data['user']->can("add_payment"))
        {
            return App::abort(401);
        }

        $action = 'membership';
        $validator = Validator::make(Input::all(), GymMembershipPayment::rules($action));

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }
        else {

            $payment = new GymMembershipPayment();
            $payment->user_id = Input::get('client');
            $payment->payment_amount = Input::get('payment_amount');
            $payment->purchase_id = Input::get('purchase_id');
            $payment->payment_source = Input::get('payment_source');
            $payment->payment_date = Carbon::createFromFormat('m/d/Y', Input::get('payment_date'))->format('Y-m-d');
            $payment->remarks = Input::get('remark');
            $payment->payment_type = Input::get('payment_type');

            $payment->detail_id = $this->data['user']->detail_id;
            $payment->save();

            $payment->payment_id = 'HPR' . $payment->id;
            $payment->save();

//            Update the details of next payment in gym_client_purchases
            $purchase = GymPurchase::find(Input::get('purchase_id'));
            $purchase->paid_amount += Input::get('payment_amount');
            $purchase->payment_required = Input::get('payment_required');
            if (Input::get('payment_required') == 'no') {
                $purchase->next_payment_date = null;
            }
            else {
                $purchase->next_payment_date = Carbon::createFromFormat('m/d/Y', Input::get('next_payment_date'))->format('Y-m-d');
            }
            $purchase->save();

            Notification::send(GymClient::find(Input::get('client')), new AddPaymentNotification($payment));

            return Reply::redirect(route('gym-admin.membership-payment.index'), 'Payment Added Successfully');
        }
    }

    public function show($id) {
        if(!$this->data['user']->can("edit_payment"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Update Payment';
        $this->data['clients'] = GymClient::GetClients($this->data['user']->detail_id);
        $this->data['payment'] = GymMembershipPayment::select('gym_membership_payments.*', 'gym_client_purchases.payment_required', 'gym_client_purchases.next_payment_date as next_date')->leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'gym_membership_payments.purchase_id')->where('gym_membership_payments.id', '=', $id)->first();
        $this->data['purchases'] = GymPurchase::clientPurchases($this->data['payment']->user_id);
        $this->data['p_types'] = MerchantCustomPaymentType::where('detail_id', '=', $this->data['user']->detail_id)->get();
        $purchase = GymPurchase::find($this->data['payment']->purchase_id);
        $this->data['remaining_amount'] = ($purchase->amount_to_be_paid - $purchase->paid_amount);

        return View::make('gym-admin.payments.edit', $this->data);
    }

    public function update($id) {
        if(!$this->data['user']->can("edit_payment"))
        {
            return App::abort(401);
        }

        $action = 'membership';

        $validator = Validator::make(Input::all(), GymMembershipPayment::rules($action));

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }
        else {

            $payment = GymMembershipPayment::find($id);
            $old_amount = $payment->payment_amount;
            $payment->payment_amount = Input::get('payment_amount');
            $payment->payment_source = Input::get('payment_source');
            $payment->payment_date = Carbon::createFromFormat('m/d/Y', Input::get('payment_date'))->format('Y-m-d');
            $payment->purchase_id = Input::get('purchase_id');

            $payment->remarks = Input::get('remark');
            $payment->payment_type = Input::get('payment_type');
            $payment->detail_id = $this->data['user']->detail_id;


//            Update the details of next payment in gym_client_purchases
            $purchase = GymPurchase::find(Input::get('purchase_id'));
            $paid_amount = $purchase->paid_amount - $old_amount;

            $purchase->paid_amount = Input::get('payment_amount') + $paid_amount;
            $purchase->payment_required = Input::get('payment_required');
            if (Input::get('payment_required') == 'no') {
                $purchase->next_payment_date = null;
            }
            else {
                $purchase->next_payment_date = Carbon::createFromFormat('m/d/Y', Input::get('next_payment_date'))->format('Y-m-d');
            }
            $purchase->save();
            $payment->save();

            return Reply::redirect(route('gym-admin.membership-payment.index'), 'Payment Updated Successfully');
        }
    }

    public function destroy($id, Request $request) {
        if(!$this->data['user']->can("delete_payment"))
        {
            return App::abort(401);
        }

        if ($request->ajax()) {
            $payment = GymMembershipPayment::find($id);
            $old_amount = $payment->payment_amount;
            $payment_type = $payment->payment_type;
            if ($payment_type == null && $payment->purchase_id != null) {
                $purchase = GymPurchase::find($payment->purchase_id);
                $purchase->paid_amount = $purchase->paid_amount - $old_amount;
                $purchase->save();
            }
            GymMembershipPayment::find($id)->delete();
            return Reply::success('Payment removed successfully');
        }
        return Reply::error('Request not Valid');
    }

    public function viewReceipt($id) {
        $this->data['payment'] = GymMembershipPayment::find($id);
        return view('gym-admin.payments.receipt', $this->data);
    }

    public function emailReceipt($id) {
        $this->data['payment'] = GymMembershipPayment::find($id);
        $content = view('gym-admin.payments.email_receipt', $this->data)->render();

        $eText = $content;

        $title = "Huntplex | Payment acknowledgement #" . $this->data['payment']->payment_id;
        $mailHeading = "Payment Receipt #" . $this->data['payment']->payment_id;
        $eUrl = NULL;

        $this->emailNotification($this->data['payment']->client->email, $eText, $title, $mailHeading, $eUrl);
        return Reply::success('Receipt sent successfully');
    }

    public function clientPurchases($id) {
        $this->data['purchases'] = GymPurchase::clientPurchases($id);
        $view = view('gym-admin.purchase.client_purchase_ajax', $this->data)->render();
        return Reply::successWithData('Client purchases fetched', ['data' => $view]);
    }

    public function clientPayment($id) {
        $payAmount = Input::get('amount');
        $this->data['payment'] = GymPurchase::select(DB::raw("(amount_to_be_paid - paid_amount)-$payAmount as 'diff' "))->where('client_id', '=', $id)->first();
        return $this->data;
    }

    public function clientEditPayment($id) {
        $payAmount = Input::get('amount');
        $old_amount = Input::get('old_amount');
        $this->data['payment'] = GymPurchase::select(DB::raw("(amount_to_be_paid - (paid_amount-$old_amount))-$payAmount as 'diff' "), 'emi_days')->where('client_id', '=', $id)->first();
        return $this->data;
    }

    public function remainingPayment($id) {
        $purchaseId = $id;
        $purchase = GymPurchase::find($purchaseId);
        return ($purchase->amount_to_be_paid - $purchase->paid_amount);
    }

    /**
     * Show modal to add payment for a particular subscription
     * */
    public function addPaymentModal($id) {
        $this->data['purchase'] = GymPurchase::find($id);
        return view('gym-admin.payments.add_payment_modal',$this->data);
    }

    /**
     * Save payment from modal
     * */
    public function ajaxPaymentStore($id) {
        $purchase = GymPurchase::find($id);
        $validator = Validator::make(Input::all(), GymMembershipPayment::rules('ajax_add'));

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }
        else {

            $payment = new GymMembershipPayment();
            $payment->user_id = $purchase->client_id;
            $payment->payment_amount = Input::get('payment_amount');
            $payment->purchase_id = $purchase->id;
            $payment->payment_source = Input::get('payment_source');
            $payment->payment_date = Carbon::createFromFormat('m/d/Y', Input::get('payment_date'))->format('Y-m-d');
            $payment->remarks = Input::get('remark');
            $payment->payment_type = null;
            $payment->detail_id = $purchase->detail_id;
            $payment->save();

            $payment->payment_id = 'HPR' . $payment->id;
            $payment->save();

//          Update the details of next payment in gym_client_purchases
            $purchase->paid_amount += Input::get('payment_amount');
            $purchase->payment_required = Input::get('payment_required');
            if (Input::get('payment_required') == 'no') {
                $purchase->next_payment_date = null;
            }
            else {
                $purchase->next_payment_date = Carbon::createFromFormat('m/d/Y', Input::get('next_payment_date'))->format('Y-m-d');
            }
            $purchase->save();
            return Reply::success('Payment Added Successfully');
        }
    }


///////////////////////////////////
}
