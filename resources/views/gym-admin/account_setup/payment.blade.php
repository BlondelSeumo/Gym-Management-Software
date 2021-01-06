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
                            @if(!is_null($payment) && isset($payment->id))
                                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                            @endif
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
                                            <a href="{{ route('gym-admin.account-setup.membership') }}" class="step">
                                                <span class="number"> 2 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Membership </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('gym-admin.account-setup.client') }}" class="step">
                                                <span class="number"> 3 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Customer </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('gym-admin.account-setup.subscription') }}" class="step">
                                                <span class="number"> 4 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Subscription </span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{ route('gym-admin.account-setup.payment') }}" class="step active">
                                                <span class="number"> 5 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Payment </span>
                                            </a>
                                        </li>
                                    </ul>


                                    <div class="col-md-12">
                                        {{--<div class="form-group form-md-line-input ">--}}
                                            {{--<select class="bs-select form-control" data-live-search="true" data-size="8"--}}
                                                    {{--name="payment_type" id="payment_type">--}}
                                                {{--<option disabled value="">Select Payment Type</option>--}}
                                                {{--<option value="membership" selected>Membership</option>--}}
                                                {{--@foreach($p_types as $p_type)--}}
                                                    {{--<option value="{{$p_type->id}}">{{ucfirst($p_type->name)}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            {{--<label for="title">Payment Type</label>--}}
                                            {{--<span class="help-block"></span>--}}
                                        {{--</div>--}}


                                        <div class="form-group form-md-line-input ">
                                            <select class="bs-select form-control" data-live-search="true" data-size="8"
                                                    name="client" id="client">
                                                <option value="">Select Client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->first_name}}
                                                        &nbsp;{{$client->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="title">Client Name <span class="required" aria-required="true"> * </span></label>
                                            <span class="help-block"></span>
                                        </div>

                                        <div id="payment_for_area">

                                        </div>

                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="number" min="0" class="form-control" name="payment_amount"
                                                       id="payment_amount" @if(!is_null($payment) && isset($payment->payment_amount)) value="{{ $payment->payment_amount }}" @endif>
                                                <span class="help-block">Enter Amount</span>
                                                <span class="input-group-addon">.00</span>
                                                <label for="price">Payment Amount <span class="required" aria-required="true"> * </span></label>
                                            </div>
                                        </div>
                                        <div id="remaining_div">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <div class="input-group left-addon right-addon">
                                                    <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                    <input disabled type="number" min="0" class="form-control"
                                                           name="remaining_amount" id="remaining_amount">
                                                    <input disabled type="hidden" class="form-control"
                                                           name="remaining_amount_store" id="remaining_amount_store">

                                                    <span class="input-group-addon">.00</span>
                                                    <label for="price">Remaining Amount</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <div class="form-group form-md-radios">
                                                <label>Payment Source? <span class="required" aria-required="true"> * </span></label>

                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" value="cash" id="cash_radio" @if(!is_null($payment) && $payment->payment_source == 'cash') checked @endif
                                                               name="payment_source" class="md-radiobtn">
                                                        <label for="cash_radio">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> <i class="fa fa-money"></i> Cash
                                                        </label>
                                                    </div>
                                                    <div class="md-radio ">
                                                        <input type="radio" value="credit_card" id="credit_card_radio" @if(!is_null($payment) && $payment->payment_source == 'credit_card') checked @endif
                                                               name="payment_source" class="md-radiobtn">
                                                        <label for="credit_card_radio">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> <i class="fa fa-credit-card"></i>
                                                            Credit Card </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" value="debit_card" id="debit_card_radio" @if(!is_null($payment) && $payment->payment_source == 'debit_card') checked @endif
                                                               name="payment_source" class="md-radiobtn">
                                                        <label for="debit_card_radio">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> <i class="fa fa-cc-visa"></i>
                                                            Debit Card </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" value="net_banking" id="net_banking_radio" @if(!is_null($payment) && $payment->payment_source == 'net_banking') checked @endif
                                                               name="payment_source" class="md-radiobtn">
                                                        <label for="net_banking_radio">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> <i
                                                                    class="fa fa-internet-explorer"></i> Net Banking
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="help-block"></span>
                                        </div>


                                        <div class="form-group form-md-line-input ">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control date-picker" readonly
                                                       name="payment_date"
                                                       value="@if(!is_null($payment) && isset($payment->payment_date)) {{ $payment->payment_date->format('m/d/Y') }} @else {{ \Carbon\Carbon::now('Asia/Calcutta')->format('m/d/Y') }} @endif"
                                                       id="payment_date">
                                                <label for="payment_date">Payment Date</label>
                                            </div>
                                        </div>

                                        <div id="onlyMembership">
                                            <div class="form-group form-md-line-input">
                                                <div class="form-group form-md-radios">
                                                    <label>More Payment Remaining?</label>

                                                    <div class="md-radio-inline">
                                                        <div class="md-radio">
                                                            <input type="radio" value="yes" id="yes_radio"
                                                                   name="payment_required" class="md-radiobtn">
                                                            <label for="yes_radio">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> Yes </label>
                                                        </div>
                                                        <div class="md-radio ">
                                                            <input type="radio" value="no" id="no_radio"
                                                                   name="payment_required" checked class="md-radiobtn">
                                                            <label for="no_radio">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> No </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="help-block"></span>
                                            </div>

                                            <div class="form-group form-md-line-input " id="next_payment_div"
                                                 style="display: none">
                                                <div class="input-group left-addon right-addon">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control date-picker" readonly
                                                           name="next_payment_date" id="next_payment_date">
                                                    <label for="payment_date">Next Payment Date</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-md-line-input ">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" placeholder="Remarks" @if(!is_null($payment) && isset($payment->remark)) value="{{ $payment->remark }}" @endif
                                                               name="remark" id="remark">
                                                        <label for="form_control_1">Remark</label>
                                                        <span class="help-block">Add payment remark</span>
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="javascript:;" class="btn green" id="save-form">Submit</a>
                                                <a href="javascript:;" class="btn default">Cancel</a>
                                            </div>
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

        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
                $("document").ready(function () {
                    $('#onlyMembership').css('display', 'none');
                    $('#payment_for_area').html('');
                });

                $("#payment_type").change(function () {
                    var type = $("#payment_type option:selected").val();
                    $("#client").val("").change();


                    if (type != 'membership') {
                        $('#onlyMembership').css('display', 'none');
                        $('#payment_for_area').html('');
                        $("#remaining_div").css('display', 'none');
                    }
                    else if ($("#remaining_amount").val() == '') {
                        $('#onlyMembership').css('display', 'none');
                        $('#payment_for_area').html('');
                    }
                    else {
                        $("#remaining_div").css('display', 'block');
                        $('#onlyMembership').css('display', 'block');
                        $('#payment_for_area').html('');
                    }
                });

                $("#client").on("change", function () {

                    var amount = 0;
                    var clientId = $("#client").val();
                    if(clientId == '') {
                        return false;
                    }
                    var url = '{{route('gym-admin.gympurchase.clientPayment',[':id'])}}';
                    url = url.replace(':id', clientId);
                    remaining(amount, url);
                });

                @if(!is_null($payment) && isset($payment->user_id))
                    $(function() {
                        var amount = 0;
                        var clientId = '{{ $payment->user_id }}';
                        $('#client').selectpicker('val', clientId);
                        var url = '{{route('gym-admin.gympurchase.clientPayment',[':id'])}}';
                        url = url.replace(':id', clientId);
                        $.easyAjax({
                            url : url,
                            type:'GET',
                            data: { amount:amount},
                            success:function(response)
                            {
                                $("#remaining_amount").addClass("edited");
                                if(parseFloat(response.payment.diff) < 0){
                                    response.payment.diff = 0;
                                }
                                $("#remaining_amount").val(response.payment.diff);
                                $("#remaining_amount_store").val(response.payment.diff);
                                if(response.payment.diff >= 0)
                                {
                                    $('#onlyMembership').css('display','block');
                                    $('#next_payment_div').css('display','block');
                                    $("#next_payment_date").datepicker( "setDate" , '+'+response.payment.emi_days+'d' );
                                    //$("#next_payment_date").val('');
                                }
                            }
                        });

                        if (clientId == "")return false;
//                        var type = $("#payment_type option:selected").val();
//                        if (type == 'membership') {
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
//                        }
                    });
                @endif

                $('#storePayments').on('change', '#purchase_id', function () {
                    var purchaseId = $(this).val();
                    var url = '{{route('gym-admin.gympurchase.remainingPayment',[':id'])}}';
                    url = url.replace(':id', purchaseId);
                    $.easyAjax({
                        url: url,
                        type: 'GET',
                        data: {purchaseId: purchaseId},
                        success: function (response) {
                            $('#remaining_amount').val(response);
                            $('#remaining_amount_store').val(response);
                        }
                    })
                });

                $('#payment_amount').on("input", function () {
                    var amount = this.value;
                    var clientId = $("#client").val();
                    var remaining = $("#remaining_amount_store").val() - amount;
                    $("#remaining_amount").addClass("edited");
                    if (parseFloat(remaining) < 0) {
                        remaining = 0;
                    }
                    $("#remaining_amount").val(remaining);
                    // remaining(amount,url);

                });

                function remaining(amount,url) {
                    $.easyAjax({
                        url : url,
                        type:'GET',
                        data: { amount:amount},
                        success:function(response)
                        {
                            $("#remaining_amount").addClass("edited");
                            if(parseFloat(response.payment.diff) < 0){
                                response.payment.diff = 0;
                            }
                            $("#remaining_amount").val(response.payment.diff);
                            $("#remaining_amount_store").val(response.payment.diff);
                            if(response.payment.diff >= 0)
                            {
                                $('#onlyMembership').css('display','block');
                                $('#next_payment_div').css('display','block');
                                $("#next_payment_date").datepicker( "setDate" , '+'+response.payment.emi_days+'d' );
                                //$("#next_payment_date").val('');
                            }
                        }
                    })
                }


                $("input[name='payment_required']").change(function () {
                    var type = $("input[name='payment_required']:checked").val();
                    var remainingAmount = $('#remaining_amount').val();
                    if (type == 'yes') {
                        if(remainingAmount == 0) {
                            $('.modal-title').text('Note');
                            $('.modal-body').text('You have checked remaining payment to yes, as there are no remaining payment');
                            $('#basic').modal('show');
                        }
                        $('#next_payment_div').css('display', 'block');
                    } else {
                        if(remainingAmount > 0) {
                            $('.modal-title').text('Note');
                            $('.modal-body').text('You have checked remaining payment to no, as there are remaining payment');
                            $('#basic').modal('show');
                        }
                        $('#next_payment_div').css('display', 'none');
                    }
                });


                $('#client').change(function () {
                    var clientId = $(this).val();

                    if (clientId == "")return false;
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

                $('#payment_amount').keyup(function(){
                    var remainingAmount = $('#remaining_amount_store').val();
                    var total = remainingAmount - $(this).val();
                    if(total > 0) {
                        $('#yes_radio').prop("checked", true);
                    } else {
                        $('#no_radio').prop("checked", true);
                    }
                });
            </script>
@stop