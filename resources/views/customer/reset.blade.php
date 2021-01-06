@extends('layouts.customer.login')

@section('title')
    Fitsigma | Reset Password
@endsection

@section('content')
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                {!! Form::open(array('route' => ['customer.update-password'], 'method' => 'POST', "id" => "resetform", "class" => 'ajax-form form-horizontal form-material')) !!}
                    <h3 class="box-title m-b-20">Recover Password</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="New Password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Confirm Password" name="confirm-password">
                        </div>
                    </div>
                    <input type="hidden" name="reset_token" value="{{ $customer->reset_password_token }}">
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

@section('JS')
    <script>
        $('#resetform').on('submit', function (event) {
            event.preventDefault();
            $.easyAjax({
                url: '{{ route('customer.update-password') }}',
                type: 'POST',
                data: $('#resetform').serialize(),
                container: '#resetform'
            });

            return false;
        });
    </script>
@endsection