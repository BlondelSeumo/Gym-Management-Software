<?php

namespace App\Http\Controllers\GymAdmin;

use App\Models\AceFeatures;
use App\Models\AcePlans;
use App\Models\AcePurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Razorpay\Api\Api;

class GymMerchantPurchaseController extends GymAdminBaseController
{

    public function index() {

        $this->data['title'] = 'Upgrade Plan';
        $this->data['plans'] = AcePlans::fitnessPlans(1);
        $this->data['features'] = AceFeatures::fitnessFeatures(1);
        return view('gym-admin.gympurchase.index', $this->data);
    }

    public function show($id) {
        if(request()->ajax()){

            $plan = AcePlans::find($id);

            $payment = new AcePurchase();
            $payment->detail_id = $this->data['user']->detail_id;
            $payment->plan_id = $id;
            $payment->sub_total = $plan->plan_price;
            $payment->grand_total = $plan->plan_price;
            $payment->payment_gateway = 'Razorpay';
            $payment->payment_method = 'Online';  // Cash, online, bank transfer
            $payment->status = 'unpaid';
            $payment->plan_starts_on = Carbon::today('Asia/Calcutta');
            $payment->plan_expires_on = Carbon::today('Asia/Calcutta')->addDays($plan->plan_duration_days);
            $payment->plan_status = 'active';
            $payment->save();
            $payment->purchase_id = 'ACE'.$payment->id;
            $payment->save();

            $amount = $payment->grand_total * 100; // Convert paise to rupees

            $data = [
                'payment_id' => $payment->purchase_id,
                'amount'    => $amount,
                'status'     => 'success',
            ];

            return $data;
        }
    }

    public function store() {
        $paymentId = Input::get('paymentId');

        $apiKey = env('RAZORPAY_KEY');
        $secretKey = env('RAZORPAY_SECRET_KEY');
        $api = new Api($apiKey, $secretKey);
        $payment = $api->payment->fetch($paymentId); // Returns a particular payment
        $purchaseId = $payment->notes->purchase_id;

        $purchase = AcePurchase::getByPurchaseId($purchaseId);
        $amount = $purchase->grand_total * 100;

        if($amount == $payment->amount && $payment->status == "authorized") {
            $payment->capture(array('amount' => $payment->amount));

            $purchase->status = 'paid';
            $purchase->transaction_id = $paymentId;
            $purchase->save();

            $message = "Dear ".$this->data['user']->first_name." ".$this->data['user']->last_name. " your payment for ".ucwords($purchase->plan->plan_name).' plan is successful.';

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
