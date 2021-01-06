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
                <span>Edit Payment</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-7">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-pencil font-red"></i><span class="caption-subject font-red bold uppercase">Edit Payment</span></div>


                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            {!! Form::open(['id'=>'updatePayments','class'=>'ajax-form','method'=>'POST']) !!}
                            <div class="form-body">
                                <input type="hidden" name="_method" value="put">

                                <div class="form-group form-md-line-input ">
                                    {{ $payment->client->first_name.' '.$payment->client->last_name }}
                                </div>
                                <input type="hidden" name="client" value="{{$payment->client->first_name    }}">

                                {{--<div class="form-group form-md-line-input ">--}}
                                    {{--<select  class="bs-select form-control" data-live-search="true" data-size="8" name="payment_type" id="payment_type">--}}
                                        {{--<option value="">Select Payment Type</option>--}}
                                        {{--<option value="membership" @if($payment->payment_type == null) selected @endif>Membership</option>--}}
                                            {{--@if($p_types)--}}
                                                {{--@foreach($p_types as $p_type)--}}
                                                    {{--<option value="{{$p_type->id}}" @if($p_type->id == $payment->payment_type) selected @endif>{{ucfirst($p_type->name)}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                    {{--</select>--}}
                                    {{--<label for="title">Payment Type</label>--}}
                                    {{--<span class="help-block"></span>--}}
                                {{--</div>--}}

                                <div class="form-group form-md-line-input " id="purchase_select">
                                    <select  class="bs-select form-control" data-live-search="true" data-size="8" name="purchase_id" id="purchase_id">
                                        @forelse($purchases as $purc)
                                            @if(!is_null($purc->membership_id))
                                                <option @if($purc->id == $payment->purchase_id) selected @endif value="{{$purc->id}}">{{ ucwords($purc->membership->title) }} - [Purchased on: {{$purc->purchase_date->format('d-M')}}]</option>
                                            @elseif(!is_null($purc->offer_id))
                                                <option value="{{$purc->id}}">{{ ucwords($purc->offer->title) }}&nbsp;<{{$purc->purchase_date->format('d-M')}}></option>
                                            @elseif(!is_null($purc->package_id))
                                                <option value="{{$purc->id}}">{{ ucwords($purc->package->title) }}&nbsp;<{{$purc->purchase_date->format('d-M')}}></option>
                                            @endif
                                        @empty
                                            <option value="">No purchase by this client</option>
                                        @endforelse
                                    </select>
                                    <label for="title">Payment For</label>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group left-addon right-addon">
                                        <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                        <input type="number" min="0" class="form-control" name="payment_amount" id="payment_amount" value="{{$payment->payment_amount}}">
                                        <span class="help-block">Enter Amount</span>
                                        <span class="input-group-addon">.00</span>
                                        <label for="price">Payment Amount</label>
                                    </div>
                                </div>

                                <div id="remaining_div">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <div class="input-group left-addon right-addon">
                                            <span class="input-group-addon"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                            <input disabled type="text" class="form-control" name="remaining_amount" id="remaining_amount" value="{{ $remaining_amount }}">
                                            <input disabled type="hidden" class="form-control" name="remaining_amount_store" id="remaining_amount_store" value="{{ $remaining_amount }}">
                                            <span class="input-group-addon">.00</span>
                                            <label for="price">Remaining Amount</label>
                                        </div>
                                    </div></div>


                                <div class="form-group form-md-line-input">
                                    <div class="form-group form-md-radios">
                                        <label>Payment Source?</label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" value="cash" id="cash_radio" name="payment_source" class="md-radiobtn" @if($payment->payment_source == 'cash') checked @endif>
                                                <label for="cash_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Cash <i class="fa fa-money"></i></label>
                                            </div>
                                            <div class="md-radio ">
                                                <input type="radio" value="credit_card" id="credit_card_radio" name="payment_source" class="md-radiobtn" @if($payment->payment_source == 'credit_card') checked @endif >
                                                <label for="credit_card_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Credit Card <i class="fa fa-credit-card"></i></label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" value="debit_card" id="debit_card_radio" name="payment_source" class="md-radiobtn" @if($payment->payment_source == 'debit_card') checked @endif>
                                                <label for="debit_card_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Debit Card <i class="fa fa-cc-visa"></i></label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" value="net_banking" id="net_banking_radio" name="payment_source" class="md-radiobtn" @if($payment->payment_source == 'net_banking') checked @endif>
                                                <label for="net_banking_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Net Banking <i class="fa fa-internet-explorer"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group form-md-line-input ">
                                    <div class="input-group left-addon right-addon">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" readonly class="form-control date-picker" value="{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$payment->payment_date)->format('m/d/Y')}}" name="payment_date" id="payment_date">
                                        <label for="payment_date">Payment Date</label>
                                    </div>
                                </div>
                            <div id="onlyMembership" @if($payment->payment_type != null) style="display: none" @endif>
                                <div class="form-group form-md-line-input">
                                    <div class="form-group form-md-radios">
                                        <label>More Payment Required</label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" value="yes" id="yes_radio" name="payment_required" class="md-radiobtn" @if($payment->payment_required == 'yes') checked @endif>
                                                <label for="yes_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Yes </label>
                                            </div>
                                            <div class="md-radio ">
                                                <input type="radio" value="no" id="no_radio" name="payment_required" class="md-radiobtn"  @if($payment->payment_required == 'no' || $payment->payment_required == '') checked @endif>
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
                                        <input type="text" class="form-control date-picker" readonly name="next_payment_date" id="next_payment_date" @if($payment->payment_required == 'yes') value="{{\Carbon\Carbon::createFromFormat('Y-m-d',$payment->next_date)->format('m/d/Y')}}" @endif>
                                        <label for="payment_date">Next Payment Date</label>
                                    </div>
                                </div>
                            </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Remarks" name="remark" id="remark" value="{{$payment->remarks}}">
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
        @if($payment->payment_required == 'yes')
            $('#next_payment_div').css('display','block');
        @else
            $('#next_payment_div').css('display','none');
        @endif

         $("input[name='payment_required']").change(function(){
            var type = $("input[name='payment_required']:checked").val();
            var remainingAmount = $('#remaining_amount').val();
            if(type == 'yes')
            {
                if(remainingAmount == 0) {
                    $('.modal-title').text('Note');
                    $('.modal-body').text('You have checked remaining payment to yes, as there are no remaining payment');
                    $('#basic').modal('show');
                }
                $('#next_payment_div').css('display','block');
            }else {
                if(remainingAmount > 0) {
                    $('.modal-title').text('Note');
                    $('.modal-body').text('You have checked remaining payment to no, as there are remaining payment');
                    $('#basic').modal('show');
                }
                $('#next_payment_div').css('display','none');
            }
        });
        $("#payment_type").change(function(){
            var type = $("#payment_type option:selected").val();

            if(type != 'membership'){
                $('#purchase_select').css('display','none');
                $('#onlyMembership').css('display','none');
            }else {
                $('#purchase_select').css('display','block');
                $('#onlyMembership').css('display','block');
            }
        });


        $('#payment_amount').on("input", function() {
            var amount = this.value;
            var old_amount ={{$payment->payment_amount}};
            var url = '{{route('gym-admin.gympurchase.clientEditPayment',[':id'])}}';
            url = url.replace(':id','{{$payment->client->id}}');

            var remaining = $("#remaining_amount_store").val()-(amount-old_amount);
            $("#remaining_amount").addClass("edited");
            if(parseFloat(remaining) < 0){
                remaining = 0;
            }
            $("#remaining_amount").val(remaining);
           // remaining(amount,url,old_amount);

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


        function remaining(amount,url,old_amount)
        {
            $.easyAjax({
                url : url,
                type:'GET',
                data: { amount:amount,old_amount:old_amount},
                success:function(response)
                {
                    $("#remaining_amount").addClass("edited");
                    if(parseFloat(response.payment.diff) < 0){
                        response.payment.diff = 0;
                    }
                    $("#remaining_amount").val(response.payment.diff);
                    $("#remaining_amount_store").val(response.payment.diff);
                    if(response.payment.diff > 0)
                    {
                        $('#onlyMembership').css('display','block');
                        $('#next_payment_div').css('display','block');
                        $("#next_payment_date").datepicker( "setDate" , '+'+response.payment.emi_days+'d'  );
                        //$("#next_payment_date").val('');
                    }
                    else
                    {
                        $('#onlyMembership').css('display','none');
                        $('#next_payment_div').css('display','none');
                      // $("#next_payment_date").datepicker( "setDate" , '+'+response.payment.emi_days+'d'  );
                    }
                }
            })
        }


    </script>
    <script>
        $('#save-form').click(function(){
            var url_update = '{{route('gym-admin.membership-payment.update',[':id'])}}';
            var url = url_update.replace(':id','{{$payment->id}}');
            var type = $("input[name='payment_required']:checked").val();
            if(type == 'yes' && $('#next_payment_date').val()=='')
            {
                $.showToastr('Next payment date is required','error');
            }else
            {
                $.easyAjax({
                    url:url,
                    container:'#updatePayments',
                    type: "POST",
                    data:$('#updatePayments').serialize()
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