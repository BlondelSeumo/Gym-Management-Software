@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}

    {!! HTML::style('admin/pages/css/invoice.min.css') !!}
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}

    <style type="text/css" media="print">
        .no-print { display: none; }
        .only-print{ display: block;}
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
                <a href="{{ route('gym-admin.gym-invoice.index') }}">Invoices</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Generate Invoice</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            <div class="row">
                <div class="col-xs-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title no-print">
                            <div class="caption">
                                <i class="icon-doc font-red"></i><span class="caption-subject font-red bold uppercase">Generate Invoice</span></div>


                        </div>
                        <div class="portlet-body">
                            <div class="invoice">
                                <div class="row invoice-logo">
                                    <div class="col-xs-6 invoice-logo-space">
                                        @if(is_null($settings))
                                            <img src="{{ $gymSettingPath.'fitsigma-logo-full.png' }}" class="img-responsive" alt="" />
                                        @elseif($settings->image == '')
                                            <img src="{{ $gymSettingPath.'fitsigma-logo-full.png' }}" class="img-responsive" alt="" />
                                        @else
                                            <img src="{{ $gymSettingPath.$settings->image }}" alt="" class="img-responsive" style="max-height: 40px" />
                                        @endif
                                    </div>
                                    <div class="col-xs-6">
                                        <p>Invoice #{{ $invoice->invoice_number }}
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row invoice-cust-add">
                                    <div class="col-xs-6 col-md-3">
                                        <h4 class="invoice-title uppercase">Customer</h4>
                                        <p class="invoice-desc">
                                            {{ ucwords($invoice->client_name) }}
                                        </p>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <h4 class="invoice-title uppercase">Date</h4>
                                        <p class="invoice-desc">{{ $invoice->invoice_date->format('M d, Y') }}</p>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <h4 class="invoice-title uppercase">Address</h4>
                                        <p class="invoice-desc inv-address">{{ ucwords($invoice->client_address) }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> Item </th>
                                                <th class="hidden-xs"> Quanity </th>
                                                <th class="hidden-xs"> Cost Per Item </th>
                                                <th> Total </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($invoice->items as $key=>$item)
                                                @if($item->item_type == 'item')
                                                    <tr>
                                                        <td> {{ $key }} </td>
                                                        <td> {{ ucfirst($item->item_name) }} </td>
                                                        <td class="hidden-xs"> {{ $item->quantity }} </td>
                                                        <td class="hidden-xs"> {{ $gymSettings->currency->acronym }} {{ $item->cost_per_item }} </td>
                                                        <td> {{ $gymSettings->currency->acronym }} {{ $item->amount }} </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                        <div class="well">
                                            <address>
                                                <strong>{{ ucwords($merchantBusiness->business->title) }}</strong>
                                                @if(!is_null($settings))<br>{{ ucfirst($settings->address) }}@endif
                                                @if(!is_null($settings))<br><abbr title="Phone">P:</abbr> {{ $settings->mobile }} @endif
                                            </address>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-8 invoice-block">
                                        <ul class="list-unstyled amounts">
                                            <li>
                                                <strong>Sub - Total amount:</strong> {{ $gymSettings->currency->acronym }} {{ round($invoice->sub_total, 2) }}
                                            </li>
                                            @foreach($invoice->items as $key=>$item)
                                                @if($item->item_type != 'item')
                                                    <li>
                                                        <strong>@if($item->item_type == 'discount')Discount:@else {{ strtoupper($item->item_name) }}: @endif</strong> {{ $gymSettings->currency->acronym }} {{ round($item->amount, 2) }}
                                                    </li>
                                                @endif
                                            @endforeach

                                            <li>
                                                <strong>Grand Total:</strong> {{ $gymSettings->currency->acronym }} {{ round($invoice->total, 2) }}
                                            </li>
                                        </ul>
                                        <br/>
                                        @if($isDesktop)
                                            <a href="{{ route('gym-admin.gym-invoice.download-invoice', $invoice->id) }}" class="btn btn-lg green hidden-print margin-bottom-5"> Download
                                                <i class="fa fa-download"></i>
                                            </a>
                                        @endif
                                        <a href="javascript:;"  data-toggle="modal" data-target="#email-invoice-modal" class="btn btn-lg red-flamingo hidden-print margin-bottom-5"> Email
                                            <i class="fa fa-send-o"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <em>Invoice generated by: {{ ucwords($invoice->generated_by) }}</em>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>


    {{--Model--}}

    <div class="modal fade bs-modal-md in" id="email-invoice-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"><i class="fa fa-send"></i> Email Invoice</span>
                </div>
                <div class="modal-body">

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-icon">
                                        <input type="text" class="form-control"  name="client_email" id="client_email" value="{{ $invoice->email }}">
                                        <label for="form_control_1">Email</label>
                                        <span class="help-block">Enter client email</span>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue mt-ladda-btn ladda-button" data-style="zoom-in" id="email-invoice">
                        <span class="ladda-label"><i class="fa fa-send"></i> Send Email</span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--Model End--}}
@stop

@section('footer')

    {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}


    <script>

        $("input[name='payment_required']").change(function(){
            var type = $("input[name='payment_required']:checked").val();
            if(type == 'yes')
            {
                $('#next_payment_div').css('display','block');
            }else {
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
        $('#email-invoice').click(function(){

            $.easyAjax({
                url:'{{ route('gym-admin.gym-invoice.email-invoice') }}',
                type: "POST",
                data:{client_email: $('#client_email').val(),invoiceId: '{{ $invoice->id }}','_token': '{{ csrf_token() }}'},
                success:function(response){
                    if(response.status != 'fail'){
                        $('#email-invoice-modal').modal('hide');
                    }
                }
            })
        });

    </script>
@stop