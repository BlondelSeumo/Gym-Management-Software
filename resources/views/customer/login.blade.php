@extends('layouts.customer.login')

@section('title')
    Fitsigma | Customer Login
@endsection

@section('content')
    <section id="wrapper" class="login-register">
        <div class="login-box login-sidebar">
            <div class="white-box">
                {!! Form::open(array('route' => ['customer.store'], 'method' => 'POST', "id" => "loginform", "class" => 'ajax-form form-horizontal form-material')) !!}
                <div class="form-body">
                    <a href="javascript:void(0)" class="text-center db">
                        <img src="{{ asset('fitsigma/images/fitsigma-logo-full-red.png') }}" height="60px">
                    </a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox" name="remember">
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" id="login-btn" type="submit">Log In</button>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">--}}
                            {{--<div class="social">--}}
                                {{--<a href="{{ route('customer.social-login', ['facebook']) }}" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i class="fa fa-facebook"></i> </a>--}}
                                {{--<a href="{{ route('customer.social-login', ['google']) }}" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i class="fa fa-google-plus"></i> </a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Don't have an account? <a href="{{ route('customer.register') }}" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

                {!! Form::open(array('route' => ['customer.send-reset-link'], 'method' => 'POST', "id" => "recoverform", "class" => 'ajax-form form-horizontal')) !!}
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" id="reset-btn" type="submit">Reset</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

@section('JS')
    <script>
        $('#loginform').on('submit', function (event) {
            event.preventDefault();
            $.easyAjax({
                url: '{{ route('customer.store') }}',
                type: 'POST',
                data: $('#loginform').serialize(),
                container: '#loginform'
            });

            return false;
        });

        $('#recoverform').on('submit', function (event) {
            event.preventDefault();
            $.easyAjax({
                url: '{{ route('customer.send-reset-link') }}',
                type: 'POST',
                data: $('#recoverform').serialize(),
                container: '#recoverform'
            });

            return false;
        });
    </script>
@endsection