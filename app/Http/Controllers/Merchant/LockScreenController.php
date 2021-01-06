<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MerchantBaseController;
use App\Models\GymSetting;
use App\Models\MerchantBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LockScreenController extends MerchantBaseController
{

    public function get(Request $request)
    {
        // only if user is logged in
        if($this->data['userCheck']) {

            $request->session()->put('locked', true);
            $business = MerchantBusiness::where('merchant_id','=', $this->data['userValue']->id)->first();
            $this->data['gymSettings'] = GymSetting::GetMerchantInfo($business->detail_id);

            return view('gym-admin.lockscreen', $this->data);
        }

        return redirect()->route('merchant.login.index');
    }

    public function post(Request $request)
    {
        $auth	=	false;
        // if user in not logged in
        if(!$this->data['userCheck'])
            return redirect('/login');


        $credentials = [
            "username" => $this->data['userValue']->username,
            "password" => trim(Input::get('password'))
        ];
        if (Auth::guard('merchant')->attempt($credentials)) {
            // Authentication passed...
            $auth	=	true;
            $message	=	'Redirecting you to dashboard';

            $request->session()->forget('locked');
             $url = route('gym-admin.dashboard.index');
        } else {
            $message = 'Invalid password';
            $url = '';
        }

        return response()->json([
            'success' => $auth,
            'url' => $url,
            'message' => $message
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('merchant')->logout();

        //remove business_id session
        if($request->session()->has('business_id')){
            $request->session()->forget('business_id');
        }

        //remove business_id session
        if($request->session()->has('locked')){
            $request->session()->forget('locked');
        }

        return redirect()->route('merchant.login.index');
    }

    public function keepAlive()
    {
        return 'OK';
    }
}
