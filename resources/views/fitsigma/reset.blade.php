@extends('layouts.merchant.login')

@section('content')

    <!-- BEGIN FORGOT PASSWORD FORM -->
    {!! Form::open(array('route' => ['merchant.login.update-password'], 'method' => 'POST', "id" => "update-password-form", "class" => 'login-form')) !!}
    <h3>Reset Password Wizard</h3>

    <div class="alert display-hide">

    </div>

    <div id="reset-form-fields">
        <p> Enter your new password. </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-key"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="password" /> </div>
        </div>

        <p> Re-enter New Password. </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-key"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="confirm_password" /> </div>
        </div>

        <input type="hidden" name="reset_token" value="{{ $merchant->reset_password_token }}">

        <div class="form-actions">
            <button type="submit" class="btn green pull-right"> Submit </button>
        </div>

    </div>
    {!! Form::close() !!}
    <!-- END FORGOT PASSWORD FORM -->

@stop