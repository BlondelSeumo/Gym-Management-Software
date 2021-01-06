<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\MerchantSmsCredit;
use App\Models\MerchantSmsPurchase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Razorpay\Api\Api;
use Yajra\Datatables\Facades\Datatables;

class GymMerchantCreditController extends GymAdminBaseController 
{

    public function __construct() {
        parent::__construct();
        $this->data['promotionMenu'] = 'active';
        $this->data['smscreditsMenu'] = 'active';

    }
    
    public function index() {
        if(!$this->data['user']->can("buy_sms_credits"))
        {
            return App::abort(401);
        }

        $this->data['title'] = "SMS Credits";
        $credits = MerchantSmsCredit::where('merchant_id', '=', $this->data['user']->id)->first();

        if($credits == null) {
            $this->data['credits'] = 0;
        }
        else {
            $this->data['credits'] = $credits->credit_balance;
        }

        $this->data['creditsTransactions'] = MerchantSmsPurchase::where('merchant_id', '=', $this->data['user']->id)
            ->where('status', '!=', 'pending')
            ->count();
        return View::make('gym-admin.credits.index', $this->data);
    }

    public function ajax_create() {
        if(!$this->data['user']->can("buy_sms_credits"))
        {
            return App::abort(401);
        }

        $transactions = MerchantSmsPurchase::select('credit_purchased', 'cost_per_credit', 'grand_total', 'status', 'created_at')
            ->where('merchant_id', '=', $this->data['user']->id)
            ->where('status', '!=', 'pending')
            ->orderBy('id', 'desc');

        return Datatables::of($transactions)
            ->edit_column('grand_total', function ($row) {
                return "<i class='fa fa-inr'></i> ".$row->grand_total;
            }, 2)
            ->edit_column('status', function($row){
               if($row->status == 'pending'){
                   return "<span class=\"label uppercase bg-yellow-saffron\"> Pending </span>";
               }elseif ($row->status == 'queued'){
                   return "<span class=\"label uppercase bg-blue-steel\"> Queued </span>";
               }elseif ($row->status == 'credited'){
                   return "<span class=\"label uppercase  bg-green-meadow \"> Credited </span>";
               }else{
                   return "<span class=\"label uppercase bg-red-thunderbird\"> Rejected </span>";
               }
            })->edit_column('created_at',function ($row){
                return $row->created_at->toFormattedDateString();
            })
            ->rawColumns([2,3])
            ->make();
    }

    public function confirmCreditsAdd() {

        if(!$this->data['user']->can("buy_sms_credits"))
        {
            return App::abort(401);
        }

        $validator = Validator::make(Input::all(), ['credits' => 'required|numeric']);

        if($validator->fails()) {
            $data = [
                'status' => 'fail',
                'credit' => 'credits cannot be null'
            ];
            return $data;
        }
        else{
            $payment = new MerchantSmsPurchase();
            $payment->merchant_id = $this->data['user']->id;
            $payment->credit_purchased = Input::get('credits');
            $payment->cost_per_credit = 0.20;
            $payment->sub_total = ($payment->credit_purchased * $payment->cost_per_credit);
            $payment->tax_percent = 15;
            $payment->grand_total = number_format((float)($payment->credit_purchased * $payment->cost_per_credit) + (($payment->credit_purchased * $payment->cost_per_credit) * ($payment->tax_percent / 100)), 2, '.', '');
            $payment->save();
            $payment->payment_id = 'HPSC'.$payment->id;
            $payment->save();
            
            $amount = $payment->grand_total * 100; // Convert paise to rupees

            $data = [
                'payment_id' => $payment->payment_id,
                'amount'    => $amount,
                'status'     => 'success',
            ];

            return $data;
        }
    }

    public function confirmRazorpayPayment() {
        $paymentId = Input::get('paymentId');
        $api_key = env('RAZORPAY_KEY');
        $secret_key = env('RAZORPAY_SECRET_KEY');
        $api = new Api($api_key, $secret_key);
        $payment = $api->payment->fetch($paymentId); // Returns a particular payment

        $purchaseId = $payment->notes->booking_id;

        $purchase = MerchantSmsPurchase::getByPaymentId($purchaseId);
        $amount = $purchase->grand_total * 100;

        if($amount == $payment->amount && $payment->status == "authorized") {
            $purchase->payment_gateway = 'RazorPay';
            $purchase->status           = 'queued';
            $purchase->save();
            $payment->capture(array('amount' => $payment->amount));

            $message = "Dear ".$this->data['user']->first_name." ".$this->data['user']->last_name. " your payment for ".$purchase->credit_purchased.' credits is successful your credits will be added soon.';

            if (App::environment('production')) {
                $this->smsNotification([$this->data['user']->mobile], $message);
            }

            $data = [
                'status' => 'success',
                'payment_id' => $purchaseId
            ];

            return Reply::successWithData('Transaction successful', $data);
        }

        return Reply::error('Transaction Failed');
    }

}
