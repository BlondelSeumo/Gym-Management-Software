@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
@stop

@section('content')
    <div class="container-fluid"      >

        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Account Setup 4 of 5</span>
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
                                <span class="caption-subject font-red bold uppercase"> STEP 4 of 5</span>
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
                            @if(!is_null($subscription) && isset($subscription->id))
                                <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                            @endif
                            <div class="form-wizard">
                            <div class="form-body">
                                <ul class="nav nav-pills nav-justified steps">
                                    <li >
                                        <a href="{{ route('gym-admin.account-setup.profile') }}" class="step">
                                            <span class="number"> 1 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Profile Setup </span>
                                        </a>
                                    </li>
                                    <li  >
                                        <a href="{{ route('gym-admin.account-setup.membership') }}"  class="step">
                                            <span class="number"> 2 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Membership </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('gym-admin.account-setup.client') }}" class="step active">
                                            <span class="number"> 3 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Customer </span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="{{ route('gym-admin.account-setup.subscription') }}" class="step">
                                            <span class="number"> 4 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Subscription </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="step">
                                            <span class="number"> 5 </span>
                                                                    <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Payment </span>
                                        </a>
                                    </li>
                                </ul>


                                <div class="form-group form-md-line-input">
                                    <select  class="bs-select form-control" data-live-search="true" data-size="8" name="user_id" id="user_id">
                                        @foreach($clients as $client)
                                            <option @if(!is_null($subscription) && $subscription->client_id == $client->id) selected @endif value="{{$client->id}}">{{$client->first_name}}&nbsp;{{$client->last_name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="title">Client Name</label>
                                    <span class="help-block"></span>
                                </div>

                                {{--<div class="form-group form-md-line-input">--}}
                                    {{--<select  class="bs-select form-control" data-live-search="true" data-size="8" name="payment_for" id="payment_for">--}}
                                        {{--<option disabled value="">Purchase For</option>--}}
                                        {{--<option @if(!is_null($subscription)) selected @endif value="membership">Membership</option>--}}
                                    {{--</select>--}}
                                    {{--<label for="title">Purchased Item <span class="required" aria-required="true"> * </span></label>--}}
                                    {{--<span class="help-block"></span>--}}
                                {{--</div>--}}

                                <div class="form-group form-md-line-input" id="mem_select" style="display: none">
                                    <select  class="bs-select form-control" data-live-search="true" data-size="8" name="membership_id" id="membership_id">
                                        <option value="">Select Membership</option>
                                        @foreach($memberships as $key => $membership)
                                            <optgroup label="{{$key}}">
                                                @foreach($membership as $mem)
                                                    <option @if(!is_null($subscription) && $subscription->membership_id == $mem->id) selected @endif value="{{$mem->id}}">{{$mem->title}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <label for="title">Membership</label>
                                    <span class="help-block"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="number" class="form-control" name="purchase_amount" id="purchase_amount" @if(!is_null($subscription) && isset($subscription->purchase_amount)) value="{{ $subscription->purchase_amount }}" @endif>
                                                <span class="help-block">Membership Cost</span>
                                                <span class="input-group-addon">.00</span>
                                                <label for="purchase_amount">Cost <span class="required" aria-required="true"> * </span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="text" class="form-control" name="amount_to_be_paid" id="amount_to_be_paid" @if(!is_null($subscription) && isset($subscription->amount_to_be_paid)) value="{{ $subscription->amount_to_be_paid }}" @endif>
                                                <span class="help-block">Amount to be Paid</span>
                                                <span class="input-group-addon">.00</span>
                                                <label for="amount_to_be_paid">Amount <span class="required" aria-required="true"> * </span></label>
                                            </div>
                                            <i class="fa fa-info-circle font-blue" id="amount_to_be_paid_info"  data-container="body" data-toggle="popover" data-placement="top" data-content="Enter same as membership cost if no discount is given."></i>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="text" class="form-control" name="discount" id="discount" @if(!is_null($subscription) && isset($subscription->discount)) value="{{ $subscription->discount }}" @endif>
                                                <span class="help-block">Discount Amount</span>
                                                <span class="input-group-addon">.00</span>
                                                <label for="discount">Discount</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" value="@if(!is_null($subscription) && isset($subscription->purchase_date)) {{ $subscription->purchase_date->format('m/d/Y') }} @else {{ \Carbon\Carbon::today('Asia/Calcutta')->format('m/d/Y') }} @endif" class="form-control date-picker" placeholder="Select Purchase Date" name="purchase_date" readonly id="purchase_date">
                                                <label for="form_control_1">Purchase Date <span class="required" aria-required="true"> * </span></label>
                                                <span class="help-block">Purchase Date</span>
                                                <i class="icon-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" value="@if(!is_null($subscription) && isset($subscription->start_date)) {{ $subscription->start_date->format('m/d/Y') }} @else {{ \Carbon\Carbon::today('Asia/Calcutta')->format('m/d/Y') }} @endif" class="form-control date-picker" readonly  name="start_date" id="start_date">
                                                <label for="form_control_1">Joining Date <span class="required" aria-required="true"> * </span></label>
                                                <span class="help-block">Date when client is going to come.</span>
                                                <i class="icon-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Remarks" name="remark" id="remark" @if(!is_null($subscription) && isset($subscription->remark)) value="{{ $subscription->remark }}" @endif>
                                                <label for="form_control_1">Remark</label>
                                                <span class="help-block">Add payment remark</span>
                                                <i class="fa fa-pencil"></i>
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

        $('#amount_to_be_paid_info').click(function () {
            $(this).popover('toggle');
        });


        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true
        });


        $(function () {
            $('#mem_select').css('display','block');
        });


    </script>
    <script>
        $('#save-form').click(function(){
            $.easyAjax({
                url:'{{route('gym-admin.account-setup.subscriptionStore')}}',
                container:'#storePayments',
                type: "POST",
                data:$('#storePayments').serialize(),
                redirect: true
            })
        });

    </script>
    <script>
        $('#membership_id').on('change', function () {
            var membership = $( "#membership_id option:selected" ).val();
            var type = 'membership';
            getAmount(type,membership);
        });
        $('#offer_id').on('change', function () {
            var offer = $( "#offer_id option:selected" ).val();
            var type = 'offer';
            getAmount(type,offer);
        });

        $('#discount').keyup(function () {
            var cost = $('#purchase_amount').val();
            var discount = cost - $(this).val();
            if(discount >= 0) {
                $('#amount_to_be_paid').val(discount);
            } else {
                $('#amount_to_be_paid').val(0);
            }

        });
    </script>
    <script>
        function getAmount(type,id) {

            if(id == "") {
                return false;
            }

            $.easyAjax({
                type:'POST',
                url:'{{route('gym-admin.client-purchase.get-amount')}}',
                container:"#storePayments",
                data:{'type':type,'id':id,'_token':'{{csrf_token()}}'},
                success:function (res) {
                    var purchase = $('#purchase_amount');
                    var paid = $('#amount_to_be_paid');
                    var discount =$('#discount');
                    purchase.val(res.amount);
                    purchase.addClass('edited');
                    paid.val(res.paid);
                    paid.addClass('edited');
                    discount.val(res.discount);
                    discount.addClass('edited');
                }
            })
        }
    </script>
@stop