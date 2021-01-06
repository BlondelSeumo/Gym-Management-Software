@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
@stop

@section('content')
    <div class="container-fluid">

        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Account Setup 5 of 5</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">


            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-layers font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Account setup wizard</span>
                            </div>
                            <div class="actions">
                                <span class="caption-subject font-red bold uppercase"> STEP 5 of 5</span>
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div class="col-md-12">
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                         aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                         style="width: {{ ($completedItems*(100/$completedItemsRequired)) }}%">
									<span class="sr-only">
									{{ ($completedItems*(100/$completedItemsRequired)) }}% Complete </span>
                                    </div>
                                </div>
                            </div>

                            {!! Form::open(['route'=>'gym-admin.profile.store','id'=>'storePayments','class'=>'ajax-form ','method'=>'POST','files' => true]) !!}
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="{{ route('gym-admin.account-setup.profile') }}" class="step">
                                                <span class="number"> 1 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Profile Setup </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('gym-admin.account-setup.membership') }}"  class="step">
                                                <span class="number"> 2 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Membership </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('gym-admin.account-setup.client') }}"  class="step active">
                                                <span class="number"> 3 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Customer </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('gym-admin.account-setup.subscription') }}"  class="step">
                                                <span class="number"> 4 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Subscription </span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{ route('gym-admin.account-setup.payment') }}"  class="step">
                                                <span class="number"> 5 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Payment </span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="clearfix"></div>

                                    <div class="row">
                                        <div class="col-md-12 text-center margin-top-75">
                                            <h1>
                                            <i style="font-size: 3em" class="icon-trophy font-dark"></i>
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h1 class="sbold font-dark">Yay! Account setup is complete.</h1>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="{{route('gym-admin.dashboard.index')}}" class="btn green"> Show My Dashboard <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->


        </div>
        @stop

        @section('footer')
            {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
            {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
            {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
            {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
            {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
            {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
            {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
            <script>

                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    autoclose: true
                });

                $("input[name='payment_required']").change(function () {
                    var type = $("input[name='payment_required']:checked").val();
                    if (type == 'yes') {
                        $('#next_payment_div').css('display', 'block');
                    } else {
                        $('#next_payment_div').css('display', 'none');
                    }
                });

                $("#payment_type").change(function () {
                    var type = $("#payment_type option:selected").val();
                    $("#client").val("").change();


                    if (type != 'membership') {
                        $('#onlyMembership').css('display', 'none');
                        $('#payment_for_area').html('');
                    } else {
                        $('#onlyMembership').css('display', 'block');
                    }
                });

                $('#client').change(function () {
                    var clientId = $(this).val();

                    if (clientId == "")return false;
                    var type = $("#payment_type option:selected").val();
                    if (type == 'membership') {
                        var url = '{{route('gym-admin.gympurchase.clientPurchases',[':id'])}}';
                        url = url.replace(':id', clientId);

                        $.easyAjax({
                            url: url,
                            type: 'GET',
                            data: {clientID: clientId},
                            success: function (response) {
                                $('#payment_for_area').html(response.data);
                            }
                        })
                    }
                });
            </script>
            <script>
                $('#save-form').click(function () {
                    var type = $("input[name='payment_required']:checked").val();
                    if (type == 'yes' && $('#next_payment_date').val() == '') {
                        $.showToastr('Next payment date is required', 'error');
                    } else {
                        $.easyAjax({
                            url: '{{route('gym-admin.account-setup.paymentStore')}}',
                            container: '#storePayments',
                            type: "POST",
                            data: $('#storePayments').serialize(),
                            redirect: true
                        })
                    }
                });

            </script>
@stop