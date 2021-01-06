<?php

namespace App\Http\Controllers\GymAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GymAdminLogoutController extends Controller
{
    public function index()
    {
        Auth::guard('merchant')->logout();

        //remove business_id session
        if(Session::has('business_id')){
            Session::forget('business_id');
        }

        return Redirect::route('merchant.login.index');
    }
}
