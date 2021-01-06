<?php

namespace App\Http\Controllers\Customer;

use App\Classes\Reply;
use App\Http\Requests\Customer\LoginStoreRequest;
use App\Http\Requests\Customer\RegisterStoreRequest;
use App\Http\Requests\Customer\ResetPasswordRequest;
use App\Http\Requests\Customer\UpdatePasswordRequest;
use App\Mail\FitsigmaEmailVerification;
use App\Models\BusinessCustomer;
use App\Models\Common;
use App\Models\GymClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class CustomerController extends CustomerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.login', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginStoreRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = 0;
        if($request->remember == 'on') {
            $remember = 1;
        }

        if(Auth::guard('customer')->attempt(['email' => $email, 'password' => $password], $remember)) {
            return Reply::redirect(route('customer-app.dashboard.index'), 'Redirecting to your dashboard');
        }

        return Reply::error('Invalid email/password');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register()
    {
        $this->data['branches'] = Common::all();

        return view('customer.register', $this->data);
    }

    /**
     * @param RegisterStoreRequest $request
     * @return array
     */
    public function registerStore(RegisterStoreRequest $request)
    {
        $customer = new GymClient();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->save();

        $business = new BusinessCustomer();
        $business->detail_id = $request->branch_id;
        $business->customer_id = $customer->id;
        $business->save();

        return Reply::redirect(route('customer.index'), 'Customer has been registered successfully.');
    }

    /**
     * @param ResetPasswordRequest $request
     * @return array
     */
    public function sendResetPasswordLink(ResetPasswordRequest $request)
    {
        $customer = GymClient::where('email','=', $request->email)->first();

        if(is_null($customer)) {
            return Reply::error('Email is not registered');
        } else {
            $resetToken = str_random(40);
            $customer->reset_password_token = $resetToken;
            $customer->save();

            $email = $request->email;

            $eText = 'This email was sent automatically by Fitsigma in response to your request to recover your password. This is done for your protection. Only you, the recipient of this email can take the next step in the password recover process.';

            $this->data['title'] = "Forgot Password";
            $this->data['mailHeading'] = "Reset Password";
            $this->data['emailText'] = $eText;

            $this->data['url'] = url("/customer/reset/" . $resetToken);

            Mail::to($email)->send(new FitsigmaEmailVerification($this->data));

            return Reply::success('Check your email for password reset link.');
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPassword($token)
    {
        $this->data['customer'] = GymClient::where('reset_password_token', '=', $token)->first();

        if(is_null($this->data['customer'])) {
            abort(403);
        }

        return view('customer.reset', $this->data);
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return array
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $customer = GymClient::where('reset_password_token', '=', $request->reset_token)->first();
        $customer->reset_password_token = '';
        $customer->password = Hash::make($request->password);
        $customer->save();

        return Reply::redirect(route('customer.index'), 'Password has been reset successfully');
    }

    //region Social Login

    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider, $id = null)
    {
        return Socialite::driver($provider)
//            ->with(['branch_id' => $id])
            ->redirect();
    }

    /**
     * @param $provider
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $customer = GymClient::where('email', '=', $user->email)->first();
//        print_r($provider);
//        print_r($customer);
//        die;

        if (is_null($customer))
        {
            $customer = new GymClient();
            $customer->first_name = $user->name;
            $customer->email = $user->email;
            $customer->save();

//            $business = new BusinessCustomer();
//            $business->detail_id = $request->branch_id;
//            $business->customer_id = $customer->id;
//            $business->save();

            Auth::guard('customer')->login($user);

            return Redirect::route('customer-app.dashboard.index');
        } elseif($user->email == $customer->email) {
            $customer->first_name = $user->name;
            $customer->email = $user->email;
            $customer->save();
            Auth::guard('customer')->login($user);

            return Redirect::route('customer-app.dashboard.index');
        }
    }

    //endregion

    //region Customer Logout

    /**
     * @return mixed
     */
    public function customerLogout()
    {
        $user  = Auth::guard('customer')->user();
        unset($user->detail_id);
        Auth::guard('customer')->logout();

        return Redirect::route('customer.index');
    }

    //endregion
}
