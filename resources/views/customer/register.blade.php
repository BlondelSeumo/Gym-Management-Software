@extends('layouts.customer.login')

@section('title')
    Fitsigma | Customer Register
@endsection
@section('CSS')
    <style>
        .hide-display {
            display: none;
        }
    </style>
@endsection
@section('content')
    <section id="wrapper" class="login-register">
        <div class="login-box login-sidebar">
            <div class="white-box">
                {!! Form::open(array('route' => ['customer.register-store'], 'method' => 'POST', "id" => "registerform", "class" => 'ajax-form form-horizontal form-material')) !!}
                    <a href="javascript:void(0)" class="text-center db">
                        <img src="{{ asset('fitsigma/images/fitsigma-logo-full-red.png') }}" height="60px">
                    </a>
                    <h3 class="box-title m-t-40 m-b-0">Register Now</h3><small>Create your account and enjoy</small>
                    <div class="form-group m-t-20 hide-select">
                        <div class="col-xs-12">
                            <select class="custom-select col-12" name="branch_id" id="branch">
                                <option selected disabled>Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group hide-display">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="First Name" name="first_name">
                        </div>
                    </div>
                    <div class="form-group hide-display">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Last Name" name="last_name">
                        </div>
                    </div>
                    <div class="form-group hide-display">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group hide-display">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="form-group hide-display">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Confirm Password" name="confirm_password">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20 hide-display">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                        </div>
                    </div>
                    {{--<div class="row hide-display">--}}
                        {{--<div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">--}}
                            {{--<div class="social">--}}
                                {{--<a href="{{ route('customer.social-login', ['facebook']) }}" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i class="fa fa-facebook"></i> </a>--}}
                                {{--<a href="{{ route('customer.social-login', ['google']) }}" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i class="fa fa-google-plus"></i> </a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Already have an account? <a href="{{ route('customer.index') }}" class="text-primary m-l-5"><b>Sign In</b></a></p>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

@section('JS')
<script>
    $('#branch').on('change', function () {
        $('.hide-select').hide();
        $('.hide-display').show();
        var id = $(this).val();
        var oldFacebookUrl = '{{ route('customer.social-login', ['facebook', '#id']) }}';
        var oldGoogleUrl = '{{ route('customer.social-login', ['google', '#id']) }}';
        var newFacebookUrl = oldFacebookUrl.replace('#id', id);
        var newGoogleUrl = oldGoogleUrl.replace('#id', id);
        $('.btn-facebook').attr("href", newFacebookUrl);
        $('.btn-googleplus').attr("href", newGoogleUrl);

    });

    $('#registerform').on('submit', function (event) {
        event.preventDefault();
        $.easyAjax({
            url: '{{ route('customer.register-store') }}',
            type: 'POST',
            data: $('#registerform').serialize(),
            container: '#registerform'
        });

        return false;
    });
</script>
@endsection