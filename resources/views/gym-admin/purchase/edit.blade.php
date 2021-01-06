@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
    <style>
        .status-label {
            padding-right: 20px;
        }
    </style>
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
                <a href="{{ route('gym-admin.client-purchase.index') }}">Subscription</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Purchase</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-7 col-xs-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa {{ $gymSettings->currency->symbol }} font-red"></i><span class="caption-subject font-red bold uppercase">Edit Subscription</span></div>


                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            {!! Form::open(['id'=>'updatePurchase','class'=>'ajax-form','method'=>'POST']) !!}

                            <div class="form-body">
                                    <input type = "hidden" name="_method" value="put">
                                    <input type="hidden" name="user_id" value="{{$purchase->client_id}}">

                                <p class="form-group">
                                    <p class="col-md-2">Client Name: </p>
                                    <p class="col-md-10">
                                        {{ ucwords($purchase->client->first_name.' '.$purchase->client->last_name) }}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <p class="col-md-2">Subscription: </p>
                                    <p class="col-md-10">
                                        {{ ucwords($purchaseTitle) }} <span class="label label-info">{{ ucwords($purchase->membership->subCategory->category->name) }}</span>
                                    </p>

                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="number" min="0" class="form-control" name="purchase_amount" id="purchase_amount" value="{{$purchase->purchase_amount}}">
                                                <span class="help-block">Membership Cost</span>
                                                <span class="input-group-addon">.00</span>
                                                <label for="price">Cost</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="number" min="0" class="form-control" name="amount_to_be_paid" id="amount_to_be_paid" value="{{$purchase->amount_to_be_paid}}">
                                                <span class="help-block">Amount to be Paid</span>
                                                <span class="input-group-addon">.00</span>
                                                <label for="price">Amount</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <div class="input-group left-addon right-addon">
                                                <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                                <input type="number" min="0" class="form-control" name="discount" id="discount" value="{{$purchase->discount}}">
                                                <span class="help-block">Discount Amount</span>
                                                <span class="input-group-addon">.00</span>
                                                <label for="price">Discount</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" readonly class="form-control date-picker" placeholder="Select Purchase Date" name="purchase_date" id="purchase_date" value="{{$purchase->purchase_date->format('m/d/Y')}}">
                                                <label for="form_control_1 ">Purchase Date</label>
                                                <span class="help-block">Purchase Date</span>
                                                <i class="icon-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" readonly class="form-control date-picker" placeholder="Select Start Date" name="start_date" id="start_date" value="{{$purchase->start_date->format('m/d/Y')}}">
                                                <label for="form_control_1">Start Date</label>
                                                <span class="help-block">Start Date</span>
                                                <i class="icon-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <label for="form_control_1" class="status-label">Status: </label>
                                                <input type="checkbox" @if($purchase->status == 'active') checked @endif class="make-switch" name="status" data-size="normal" data-on-color="success" data-off-color="danger">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Remarks" name="remark" id="remark" value="{{$purchase->remarks}}">
                                                <label for="form_control_1">Remark</label>
                                                <span class="help-block">Add payment remark</span>
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions" >
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-2">
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

        @if($purchase->payment_for == 'membership')
            $('#mem_select').css('display','block');
            $('#offer_select').css('display','none');
            $('#pack_select').css('display','none');
        @endif
        @if($purchase->payment_for == 'package')
            $('#mem_select').css('display','none');
            $('#offer_select').css('display','none');
            $('#pack_select').css('display','block');
        @endif
        @if($purchase->payment_for == 'offer')
            $('#mem_select').css('display','none');
            $('#offer_select').css('display','block');
            $('#pack_select').css('display','none');
        @endif
        @if($purchase->payment_required == 'yes')
            $('#next_payment_div').css('display','block');
        @else
            $('#next_payment_div').css('display','none');
        @endif
        $( "#payment_for" ).change(function() {
            var type = $( "#payment_for option:selected" ).val();
            if(type == 'membership')
            {
                $('#mem_select').css('display','block');
                $('#offer_select').css('display','none');
            }
            else if(type == 'offer'){
                $('#mem_select').css('display','none');
                $('#offer_select').css('display','block');
            }else{
                $('#mem_select').css('display','none');
                $('#offer_select').css('display','none');
            }
        });

        $("input[name='payment_required']").change(function(){
            var type = $("input[name='payment_required']:checked").val();
            if(type == 'yes')
            {
                $('#next_payment_div').css('display','block');
            }else {
                $('#next_payment_div').css('display','none');
            }
        });

    </script>
    <script>
        $('#save-form').click(function(){
            var url = '{{route('gym-admin.client-purchase.update',$purchase->id)}}';
            $.easyAjax({
                url:url,
                container:'#updatePurchase',
                type: "POST",
                data:$('#updatePurchase').serialize()
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