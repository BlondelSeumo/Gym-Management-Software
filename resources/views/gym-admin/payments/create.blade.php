@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
@stop

@section('content')
    <div class="container-fluid"  >
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('gym-admin.dashboard.index') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ route('gym-admin.membership-payment.index') }}">Payments</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Add Payment</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            @if($completedItems  < $completedItemsRequired)
                {{-- Account setup progress start --}}

                <div class="row">

                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-speedometer font-white"></i>
								<span class="caption-subject  font-white ">
								Account Setup Progress </span>
                                    <span class="caption-helper">{{ round($completedItems*(100/$completedItemsRequired),1) }}% COMPLETE</span>
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

                                @if(trim($user->first_name) == "" || trim($user->first_name) == "")
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.profile.index') }}">
                                            Update your first & last name


                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @elseif(trim($user->mobile) == "")
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.profile.index') }}">
                                            Update your mobile number

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @elseif(count($memberships) == 0)
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ URL::route('gym-admin.membership.create') }}">
                                            Add Membership

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @elseif(count($clients) == 0)
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.client.create') }}">
                                            Add First Client

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>



                                @elseif(count($subscriptions) == 0)
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.client-purchase.create') }}">
                                            Add Subscription

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @elseif(count($payments) == 0)
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.membership-payment.create') }}">
                                            Add Payment

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @endif

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- Account setup progress end --}}
            @endif


            <div class="row">
                <div class="col-md-7 col-xs-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-plus font-red"></i><span class="caption-subject font-red bold uppercase">Add Payment</span></div>


                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            {!! Form::open(['id'=>'storePayments','class'=>'ajax-form','method'=>'POST']) !!}
                            <div class="form-body">


                                {{--<div class="form-group form-md-line-input ">--}}
                                    {{--<select  class="bs-select form-acontrol" data-live-search="true" data-size="8" name="payment_type" id="payment_type">--}}
                                        {{--<option value="">Select Payment Type</option>--}}
                                        {{--<option value="membership" selected>Membership</option>--}}
                                        {{--@foreach($p_types as $p_type)--}}
                                            {{--<option value="{{$p_type->id}}" >{{ucfirst($p_type->name)}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--<label for="title">Payment Type</label>--}}
                                    {{--<span class="help-block"></span>--}}
                                {{--</div>--}}



                                <div class="form-group form-md-line-input ">
                                        <select  class="bs-select form-control" data-live-search="true" data-size="8" name="client" id="client">
                                            <option value="">Select Client</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->first_name}}&nbsp;{{$client->last_name}}</option>
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
                                        <input type="number" min="0" class="form-control" name="payment_amount" id="payment_amount">
                                        <span class="help-block">Enter Amount</span>
                                        <span class="input-group-addon">.00</span>
                                        <label for="price">Payment Amount <span class="required" aria-required="true"> * </span></label>
                                    </div>
                                </div>
                                <div id="remaining_div">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group left-addon right-addon">
                                        <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                        <input disabled type="number" min="0" class="form-control" name="remaining_amount" id="remaining_amount">
                                        <input disabled type="hidden" class="form-control" name="remaining_amount_store" id="remaining_amount_store">
                                        <span class="input-group-addon">.00</span>
                                        <label for="price">Remaining Amount</label>
                                    </div>
                                </div></div>

                                <div class="form-group form-md-line-input">
                                    <div class="form-group form-md-radios">
                                        <label>Payment Source? <span class="required" aria-required="true"> * </span></label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" value="cash" id="cash_radio" name="payment_source" class="md-radiobtn">
                                                <label for="cash_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <i class="fa fa-money"></i> Cash </label>
                                            </div>
                                            <div class="md-radio ">
                                                <input type="radio" value="credit_card" id="credit_card_radio" name="payment_source" class="md-radiobtn" >
                                                <label for="credit_card_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <i class="fa fa-credit-card"></i> Credit Card </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" value="debit_card" id="debit_card_radio" name="payment_source" class="md-radiobtn">
                                                <label for="debit_card_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <i class="fa fa-cc-visa"></i> Debit Card </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" value="net_banking" id="net_banking_radio" name="payment_source" class="md-radiobtn">
                                                <label for="net_banking_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <i class="fa fa-internet-explorer"></i> Net Banking </label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>


                                <div class="form-group form-md-line-input ">
                                    <div class="input-group left-addon right-addon">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control date-picker" readonly name="payment_date" id="payment_date" value="{{ \Carbon\Carbon::now('Asia/Calcutta')->format('m/d/Y') }}">
                                        <label for="payment_date">Payment Date</label>
                                    </div>
                                </div>

                                <div id="onlyMembership">
                                    <div class="form-group form-md-line-input">
                                        <div class="form-group form-md-radios">
                                            <label>More Payment Required</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" value="yes" id="yes_radio" name="payment_required" class="md-radiobtn" checked>
                                                    <label for="yes_radio">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Yes </label>
                                                </div>
                                                <div class="md-radio ">
                                                    <input type="radio" value="no" id="no_radio" name="payment_required" class="md-radiobtn" >
                                                    <label for="no_radio">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> No </label>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="form-group form-md-line-input " id="next_payment_div" style="display: none">
                                        <div class="input-group left-addon right-addon">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control date-picker" readonly name="next_payment_date" id="next_payment_date">
                                            <label for="payment_date">Next Payment Date</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Remarks" name="remark" id="remark">
                                                <label for="form_control_1">Remark</label>
                                                <span class="help-block">Add payment remark</span>
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions" style="margin-top: 70px">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn dark mt-ladda-btn ladda-button" data-style="zoom-in" id="save-form">
                                            <span class="ladda-label"><i class="fa fa-save"></i> SAVE</span>
                                        </button>
                                        <button type="reset" class="btn default">Reset</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                                    <!-- END FORM-->
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
    $("document").ready(function(){
        $('#onlyMembership').css('display','none');
        $('#payment_for_area').html('');
    });

    $("#payment_type").change(function(){
        var type = $("#payment_type option:selected").val();

        if(type != 'membership'){
            $('#onlyMembership').css('display','none');
            $('#payment_for_area').html('');
            $("#remaining_div").css('display','none');

            return false;
        }
        else if($("#remaining_amount").val() == '')
        {
            $('#onlyMembership').css('display','none');
            $('#payment_for_area').html('');

            return false;
        }
        else {
            $("#remaining_div").css('display','block');
            $('#onlyMembership').css('display','block');
            $('#payment_for_area').html('');

            return false;
        }

    });

    $("#client").on("change",function(){
        var amount = 0;
        var clientId = $("#client").val();
        var url = '{{route('gym-admin.gympurchase.clientPayment',[':id'])}}';
        url = url.replace(':id',clientId);
        remaining(amount,url);
    });

    $('#storePayments').on('change', '#purchase_id', function () {
        var purchaseId = $(this).val();
        var url = '{{route('gym-admin.gympurchase.remainingPayment',[':id'])}}';
        url = url.replace(':id',purchaseId);
        $.easyAjax({
            url : url,
            type:'GET',
            data: { purchaseId: purchaseId},
            success:function(response)
            {
                $('#remaining_amount').val(response);
                $('#remaining_amount_store').val(response);
            }
        })
    });

    $('#payment_amount').on("input", function() {
        var amount = this.value;
        var clientId = $("#client").val();
        var remaining = $("#remaining_amount_store").val()-amount;
        $("#remaining_amount").addClass("edited");
        if(parseFloat(remaining) < 0){
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


    $("input[name='payment_required']").change(function(){
        var type = $("input[name='payment_required']:checked").val();
        var remainingAmount = $('#remaining_amount').val();
        if(type == 'yes')
        {
            if(remainingAmount == 0) {
                $('.modal-title').text('Note');
                $('.modal-body').text('You have set remaining to no but still there is some amount remaining.');
                $('#basic').modal('show');
            }
            $('#next_payment_div').css('display','block');
        }else {
            if(remainingAmount > 0) {
                $('.modal-title').text('Note');
                $('.modal-body').text('You have set remaining to no but still there is some amount remaining.');
                $('#basic').modal('show');
            }
            $('#next_payment_div').css('display','none');
        }
    });



    $('#client').change(function () {
        var clientId = $(this).val();
        if(clientId == "")return false;
            var url = '{{route('gym-admin.gympurchase.clientPurchases',[':id'])}}';
            url = url.replace(':id',clientId);

            $.easyAjax({
                url: url,
                type: 'GET',
                data: {clientID: clientId },
                success: function(response){
                    $('#payment_for_area').html(response.data);
                }
            })
    });
</script>
    <script>
        $('#save-form').click(function(){
            var type = $("input[name='payment_required']:checked").val();

                $.easyAjax({
                    url: '{{route('gym-admin.membership-payment.store')}}',
                    container: '#storePayments',
                    type: "POST",
                    data: $('#storePayments').serialize(),
                    success: function (responce) {
                        if (responce.status == 'success') {
                            clear_form_elements('storePayments')
                        }
                    }
                })
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