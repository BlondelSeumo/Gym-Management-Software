<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Http\Requests\GymAdmin\GymAccountSetup\ClientStoreRequest;
use App\Http\Requests\GymAdmin\GymAccountSetup\MembershipStoreRequest;
use App\Http\Requests\GymAdmin\GymAccountSetup\PaymentStoreRequest;
use App\Http\Requests\GymAdmin\GymAccountSetup\ProfileStoreRequest;
use App\Http\Requests\GymAdmin\GymAccountSetup\SubscriptionStoreRequest;
use App\Models\BusinessCategory;
use App\Models\BusinessCustomer;
use App\Models\Category;
use App\Models\GymClient;
use App\Models\GymMembership;
use App\Models\GymMembershipPayment;
use App\Models\GymOffer;
use App\Models\GymPackage;
use App\Models\GymPurchase;
use App\Models\Merchant;
use App\Models\MerchantCustomPaymentType;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class GymAccountSetupController extends GymAdminBaseController
{
    public function profile() {
        $this->data['title'] = "Account Setup - Profile";
        return view('gym-admin.account_setup.profile', $this->data);
    }

    public function profileStore(ProfileStoreRequest $request) {

        $id = $request->get('id');
        $profile = Merchant::find($id);
        $profile->first_name = $request->get('first_name');
        $profile->last_name = $request->get('last_name');
        $profile->mobile = $request->get('mobile');
        $profile->gender = $request->get('gender');
        $profile->email = $request->get('email');

        if($request->get('date_of_birth') != '') {
            $profile->date_of_birth = $request->get('date_of_birth');
        }

        $profile->save();

        return Reply::redirect(route('gym-admin.account-setup.membership'), 'Congrats! Profile update is successful.');
    }

    public function membership() {
        $this->data['title'] = "Account Setup - Membership";
        $this->data['membershipindexMenu'] = '';
        $this->data['memberships'] = GymMembership::where('detail_id', '=', $this->data['user']->detail_id)
            ->first();
        return view('gym-admin.account_setup.membership', $this->data);
    }

    public function membershipStore(MembershipStoreRequest $request) {
        $category = BusinessCategory::first();
        $gymMembership = GymMembership::firstOrNew(['id' => $request->get('membership_id')]);
        $gymMembership->title = $request->get('title');
        $gymMembership->price = $request->get('price');
        $gymMembership->duration = $request->get('duration');
        $gymMembership->detail_id = $this->data['user']->detail_id;
        $gymMembership->business_category_id = $category->id;
        $gymMembership->status = 'active';
        $gymMembership->details = $request->get('details');

        $gymMembership->save();

        return Reply::redirect(route('gym-admin.account-setup.client'), 'Congrats! Membership is created successfully.');
    }

    public function client() {
        $this->data['title'] = "Account Setup - Client";
        $this->data['client'] = GymClient::join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->where('business_customers.detail_id', '=', $this->data['user']->detail_id)
            ->first();

        return view('gym-admin.account_setup.client', $this->data);
    }

    public function clientStore(ClientStoreRequest $request) {
        $gymClient = GymClient::firstOrNew(['id' => $request->get('client_id')]);
        $gymClient->first_name = $request->get('first_name');
        $gymClient->last_name = $request->get('last_name');

        if($request->get('dob') != '') {
            $gymClient->dob = Carbon::createFromFormat('m/d/Y', $request->get('dob'))->format('Y-m-d');
        }


        if($request->get('anniversary') != '') {
            $gymClient->anniversary = Carbon::createFromFormat('m/d/Y', $request->get('anniversary'))->format('Y-m-d');
        }

        $gymClient->gender = $request->get('gender');
        $gymClient->email = $request->get('email');
        $gymClient->mobile = $request->get('mobile');
        $gymClient->weight = $request->get('weight');
        $gymClient->height_inches = $request->get('height_inches');
        $gymClient->height_feet = $request->get('height_feet');
        $gymClient->address = $request->get('address');
        $gymClient->marital_status = $request->get('marital_status');
        $gymClient->client_source = $request->get('source');
        $gymClient->image = "";
        $gymClient->password = Hash::make('123456');
        $gymClient->save();

        $businessCustomer = BusinessCustomer::firstOrNew(
            ['detail_id' => $this->data['merchantBusiness']->detail_id],
            ['customer_id' => $gymClient->id]
        );
        $businessCustomer->detail_id = $this->data['merchantBusiness']->detail_id;
        $businessCustomer->customer_id = $gymClient->id;
        $businessCustomer->save();

        $data = [
            'name' => $gymClient->first_name.' '.$gymClient->last_name,
            'email' => $gymClient->email,
            'number' => $gymClient->mobile,
            'age'   => ($request->get('dob') != '')? Carbon::createFromFormat('m/d/Y', $request->get('dob'))->diff(Carbon::now())->format('%y'): null,
            'gender' => $gymClient->gender
        ];
        $this->addPromotionDatabase($data);

        return Reply::redirect(route('gym-admin.account-setup.subscription'), 'Congrats! Client is added successfully.');
    }

    public function subscription() {
        $this->data['title'] = "Account Setup - Add Subscription";
        $this->data['subscription'] = GymPurchase::where('detail_id', '=', $this->data['user']->detail_id)
            ->first();

        $business = BusinessCategory::select('categories.name', 'categories.id as id')
            ->leftJoin('categories', 'categories.id', '=', 'business_categories.category_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->get();
        $memberships = GymMembership::select('id', 'title', 'business_category_id as cat_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->get();

        $gymMembership = [];

        foreach ($memberships as $key => $membership)
        {
            foreach ($business as $b)
            {
                if($membership->cat_id == $b->id)
                {
                    $gymMembership[$b->name][$key] = $membership;
                }
            }
        }

        $this->data['memberships'] = $gymMembership;

        return view('gym-admin.account_setup.subscription', $this->data);
    }

    public function subscriptionStore(SubscriptionStoreRequest $request) {
        $purchase = GymPurchase::firstOrNew(['id' => $request->get('subscription_id')]);
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
        } else {
            $purchase->membership_id = $request->get('membership_id');
        }

        $purchase->purchase_date = Carbon::createFromFormat('m/d/Y', $request->get('purchase_date'));
        $purchase->start_date = Carbon::createFromFormat('m/d/Y', $request->get('start_date'));
        $purchase->detail_id = $this->data['user']->detail_id;
        $purchase->payment_required = 'yes';

        $purchase->next_payment_date = null;

        $purchase->remarks = $request->get('remark');
        $purchase->save();

        // Update joining date if first purchase
        $clientTotalPurchase = GymPurchase::clientPurchases($purchase->client_id);

        if(count($clientTotalPurchase) == 1) {
            $client = GymClient::find($purchase->client_id);
            $client->joining_date = $purchase->start_date;
            $client->save();
        }

        return Reply::redirect(route('gym-admin.account-setup.payment'), 'Congrats! Subscription is created successfully.');

    }

    public function payment() {
        $this->data['title'] = "Account Setup - Add Payment";
        $this->data['clients'] = GymClient::GetClients($this->data['user']->detail_id);
        $this->data['memberships'] = GymMembership::membershipsForSelect($this->data['user']->detail_id);
        $this->data['p_types'] = MerchantCustomPaymentType::where('detail_id', '=', $this->data['user']->detail_id)->get();
        $this->data['payment'] = GymMembershipPayment::where('detail_id', '=', $this->data['user']->detail_id)
            ->first();

        return view('gym-admin.account_setup.payment', $this->data);
    }

    public function paymentStore(PaymentStoreRequest $request)
    {
        $payment = GymMembershipPayment::firstOrNew(['id' => $request->get('payment_id')]);
        $payment->user_id= $request->get('client');
        $payment->payment_amount= $request->get('payment_amount');
        $payment->purchase_id = $request->get('purchase_id');

        $payment->payment_source = $request->get('payment_source');
        $payment->payment_date = Carbon::createFromFormat('m/d/Y', $request->get('payment_date'))->format('Y-m-d');
        $payment->remarks = $request->get('remark');
        $payment->payment_type = $request->get('payment_type');

        $payment->detail_id = $this->data['user']->detail_id;
        $payment->save();

        $payment->payment_id = 'HPR'.$payment->id;
        $payment->save();

//      Update the details of next payment in gym_client_purchases
        $purchase = GymPurchase::find($request->get('purchase_id'));
        $purchase->paid_amount = $request->get('payment_amount');
        $purchase->payment_required = $request->get('payment_required');
        if($request->get('payment_required') == 'no'){
            $purchase->next_payment_date = null;
        }else{
            $purchase->next_payment_date = Carbon::createFromFormat('m/d/Y', $request->get('next_payment_date'))->format('Y-m-d');
        }
        $purchase->save();

        return Reply::redirect(route('gym-admin.account-setup.complete'),'Congrats! Payment is added successfully.');
    }

    public function complete()
    {
        $this->data['title'] = "Account Setup - Complete";
        return view('gym-admin.account_setup.complete',$this->data);
    }

}
