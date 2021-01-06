<?php

namespace App\Http\Controllers\Merchant;

use App\Classes\Reply;
use App\Http\Controllers\MerchantBaseController;
use App\Http\Requests\Login\LoginRequest;
use App\Mail\FitsigmaEmailVerification;
use App\Models\GymSetting;
use App\Models\Merchant;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class MerchantsController extends MerchantBaseController
{

    public function index() {
        if ($this->data['userCheck']) {
            if (Auth::guard('merchant')->user()->is_admin != 1) {
                return Redirect::route('gym-admin.dashboard.index');
            } else {
                return Redirect::route('gym-admin.superadmin.dashboard');
            }
        }
        $this->data['gymSettings'] = GymSetting::first();
        return View::make("fitsigma.login", $this->data);
    }

    /**
     * Store a newly created merchant in storage.
     *
     * @return Response
     */
    public function store() {
        if (Request::ajax()) {
            $auth = false;

            $credentials = array(
                "username" => trim(Input::get('username')),
                "password" => trim(Input::get('password'))
            );


            if (Auth::guard('merchant')->attempt($credentials, true)) {
                $auth = true; // Success
                $message = 'Redirecting you to dashboard';
                $url = route('gym-admin.dashboard.index');
            } else {
                $message = 'Invalid username or password';
                $url = '';
            }

            return Response::json(
                [
                    'success' => $auth,
                    'url' => $url,
                    'message' => $message
                ]
            );

        }

        return 'Illegal Request';
    }

    public function sendResetPasswordLink() {

        if(trim(Input::get('email')) == '') {
            return Response::json(
                [
                    'success' => false,
                    'message' => 'Email cannot be blank.'
                ]
            );
        }

        $merchant = Merchant::getByEmail(Input::get('email'));

        if(is_null($merchant)) {
            return Response::json(
                [
                    'success' => false,
                    'message' => 'Email not registered.'
                ]
            );
        }
        else{
            $resetToken = str_random(40);
            $merchant->reset_password_token = $resetToken;
            $merchant->save();

            $email = Input::get('email');

            $eText = 'This email was sent automatically by Fitsigma in response to your request to recover your password. This is done for your protection. Only you, the recipient of this email can take the next step in the password recover process.';

            $this->data['title'] = "Forgot Password";
            $this->data['mailHeading'] = "Reset Password";
            $this->data['emailText'] = $eText;

            $this->data['url'] = url("/merchant/reset/" . $resetToken);

            Mail::to($email)->send(new FitsigmaEmailVerification($this->data));

            return Response::json(
                [
                    'success' => true,
                    'message' => 'Check your email inbox for password reset link.'
                ]
            );

        }

    }

    public function resetPassword($token) {

        $this->data['merchant'] = Merchant::where('reset_password_token', $token)->first();

        if(is_null($this->data['merchant'])) {
            abort(403);
        }
        $this->data['gymSettings'] = GymSetting::first();

        return view('fitsigma.reset', $this->data);
    }

    public function updatePassword() {
        $inputData = Input::get('formData');
        parse_str($inputData, $formFields);

        if(trim($formFields['password']) == '') {
            return Response::json(
                [
                    'success' => false,
                    'message' => 'Password cannot be blank.'
                ]
            );
        }
        elseif($formFields['password'] != $formFields['confirm_password']) {
            return Response::json(
                [
                    'success' => false,
                    'message' => 'Password does not match. Enter the same password in both fields.'
                ]
            );
        }
        elseif($formFields['password'] == $formFields['confirm_password']) {

            $merchant = Merchant::where('reset_password_token', $formFields['reset_token'])->first();

            if(is_null($merchant)) {
                return Response::json(
                    [
                        'success' => false,
                        'message' => 'Invalid reset token.'
                    ]
                );
            }

            $merchant->reset_password_token = '';
            $merchant->password = Hash::make($formFields['password']);
            $merchant->save();

            return Response::json(
                [
                    'success' => true,
                    'message' => 'Password has been reset successfully.<br> Click <strong><a href="'.route('merchant.login.index').'">here</a></strong> to login.'
                ]
            );
        }


        $merchant = Merchant::getByEmail($formFields['email']);
    }
}
