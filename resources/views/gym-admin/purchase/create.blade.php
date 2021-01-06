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
            @if($user_id != 0)
            <li>
                <a href="{{ route('gym-admin.client.index') }}">Clients</a>
                <i class="fa fa-circle"></i>
            </li>
            @else
                <li>
                    <a href="{{ route('gym-admin.client-purchase.index') }}">Subscription</a>
                    <i class="fa fa-circle"></i>
                </li>
            @endif
            <li>
                <span>Add</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            @if($completedItems  < $completedItemsRequired)
                {{-- Account setup progress start --}}

                <div class="row">

                    <div class="col-md-12">
                        <div class="portlet dark box">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-speedometer font-white"></i>
								<span class="caption-subject font-white ">
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

                                @if(trim($user->first_name) == "" || trim($user->last_name) == "")
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
                                <i class="icon-plus font-red"></i><span class="caption-subject font-red bold uppercase">Add New Subscription</span></div>


                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            {!! Form::open(['id'=>'storePayments','class'=>'ajax-form','method'=>'POST']) !!}

                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <select  class="bs-select form-control" data-live-search="true" data-size="8" name="user_id" id="user_id">
                                            <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option
                                                    @if($user_id != 0)
                                                        @if($user_id == $client->customer_id)
                                                            selected
                                                        @endif
                                                    @endif

                                                    value="{{$client->customer_id}}">{{$client->first_name}}&nbsp;{{$client->last_name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="title">Client</label>
                                    <span class="help-block"></span>
                                </div>
                                {{--<div class="form-group form-md-line-input">--}}
                                    {{--<select  class="bs-select form-control" data-live-search="true" data-size="8" name="payment_for" id="payment_for">--}}
                                        {{--<option value="">Purchase Type</option>--}}
                                        {{--<option value="membership">Membership</option>--}}
                                    {{--</select>--}}
                                    {{--<label for="title">Purchase Type</label>--}}
                                    {{--<span class="help-block"></span>--}}
                                {{--</div>--}}

                                <div class="form-group form-md-line-input" id="mem_select">
                                    <select  class="bs-select form-control" data-live-search="true" data-size="8" name="membership_id" id="membership_id">
                                        <option value="">Select Membership</option>
                                        @foreach($memberships as $key => $membership)
                                        <optgroup label="{{$key}}">
                                            @foreach($membership as $mem)
                                            <option value="{{$mem->id}}">{{$mem->title}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    <label for="title">Membership</label>
                                    <span class="help-block"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="number" class="form-control" min="0" name="purchase_amount" id="purchase_amount">
                                                <span class="help-block">Membership Cost</span>
                                                <span class="input-group-addon">.00</span>
                                                <label for="purchase_amount">Cost</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="number" class="form-control" min="0" name="amount_to_be_paid" id="amount_to_be_paid">
                                                <span class="help-block">Amount to be Paid</span>
                                                <span class="input-group-addon">.00</span>
                                                <label for="amount_to_be_paid">Amount</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="number" class="form-control" min="0" name="discount" id="discount">
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
                                                <input type="text" readonly class="form-control date-picker" placeholder="Select Purchase Date" name="purchase_date" id="purchase_date" value="{{ \Carbon\Carbon::today()->format('m/d/Y') }}">
                                                <label for="form_control_1">Registration Date</label>
                                                <span class="help-block">Enter Registration Date</span>
                                                <i class="icon-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" readonly class="form-control date-picker" placeholder="Select Start Date" name="start_date" id="start_date">
                                                <label for="form_control_1">Customer is going to come from?</label>
                                                <span class="help-block">Date from when customer will be coming from.</span>
                                                <i class="icon-calendar"></i>
                                            </div>
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

        $(document).ready(function() {

            $("#purchase_date").datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true,
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#start_date').datepicker('setStartDate', minDate);
            });

            $("#start_date").datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true,
            }).on('changeDate', function (selected) {
                var maxDate = new Date(selected.date.valueOf());
                $('#purchase_date').datepicker('setEndDate', maxDate);
            });

        });


    </script>
    <script>
        $('#save-form').click(function(){
            $.easyAjax({
                url:'{{route('gym-admin.client-purchase.store')}}',
                container:'#storePayments',
                type: "POST",
                data:$('#storePayments').serialize(),
                formReset:true,
                success:function(responce){
                    if(responce.status == 'success'){
                        $('#user_id').val('');
                        $('#user_id').selectpicker('refresh');
                        $('#payment_for').val('');
                        $('#payment_for').selectpicker('refresh');
                        $('#membership_id').val('');
                        $('#membership_id').selectpicker('refresh');
                        $('#offer_id').val('');
                        $('#offer_id').selectpicker('refresh');
                    }
                }
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

        $('#amount_to_be_paid').keyup(function () {
            var cost = $('#purchase_amount').val();
            var discount = parseInt(cost)-parseInt($(this).val());
            $('#discount').val(discount);
        });

        $('#discount').keyup(function() {
            var cost =  $('#purchase_amount').val();
            var amount = cost - $(this).val();
            if(amount <= 0) {
                $('#amount_to_be_paid').val(0);
            } else {
                $('#amount_to_be_paid').val(amount);
            }
        });

    </script>
    <script>
        function getAmount(type,id) {
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
                    paid.val(res.amount);
                    paid.addClass('edited');
                    discount.val(res.discount);
                    discount.addClass('edited');
                }
            })
        }
    </script>
@stop