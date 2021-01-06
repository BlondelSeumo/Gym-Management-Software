@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/froiden-helper/helper.css') !!}
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
                <span>Sms Credits</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row widget-row">
                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">SMS Credits</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-grid"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">Balance</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$credits}}">0</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>

                <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">Credits Purchased</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-green icon-badge"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">Transactions</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$creditsTransactions}}">0</span>
                            </div>
                        </div>
                    </div>
                <!-- END WIDGET THUMB -->
                </div>
                {{--<div class="col-md-3">--}}
                {{--<!-- BEGIN WIDGET THUMB -->--}}
                {{--<div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">--}}
                {{--<h4 class="widget-thumb-heading">Package</h4>--}}
                {{--<div class="widget-thumb-wrap">--}}
                {{--<i class="widget-thumb-icon bg-red icon-present"></i>--}}
                {{--<div class="widget-thumb-body">--}}
                {{--<span class="widget-thumb-subtitle">Count</span>--}}
                {{--<span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$packageCount}}">0</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- END WIDGET THUMB -->--}}
                {{--</div>--}}
                {{--<div class="col-md-3">--}}
                {{--<!-- BEGIN WIDGET THUMB -->--}}
                {{--<div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">--}}
                {{--<h4 class="widget-thumb-heading">Offer</h4>--}}
                {{--<div class="widget-thumb-wrap">--}}
                {{--<i class="widget-thumb-icon bg-purple fa fa-circle-thin"></i>--}}
                {{--<div class="widget-thumb-body">--}}
                {{--<span class="widget-thumb-subtitle">Count</span>--}}
                {{--<span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$offerCount}}">0</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- END WIDGET THUMB -->--}}
                {{--</div>--}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-basket font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Buy SMS Credits</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row margin-bottom-20">
                                <label class="label label-danger">NOTE:</label> Number of SMS should be greater than 1000.
                            </div>
                                <div class="row">
                                    <div class="form-body col-md-4">
                                        <div class="form-group form-md-line-input form-md-floating-label ">
                                            <input type="number" min="1000" class="form-control" id="credits" name="credits" value="1500"  >
                                            <label for="form_control_1">No. of SMS</label>
                                            <span class="help-block">Please enter number of sms credits</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="col-md-12 border-grey-salsa" style="border: 1px dashed">
                                            <h5>1 credit = <span class="sbold">0.20</span> INR</h5>
                                            <h4>1 SMS = 1 Credit / <span class="sbold">0.20</span></h4>
                                            <h4>Sub total = <span class="sbold credit-sub-total">{{ (1500 * 0.20) }}</span> INR</h4>
                                            <h4>Tax = 15%</h4>
                                            <h4>Grand total = <span class="sbold credit-grand-total">{{ (1500 * 0.20) + ((1500 * 0.20)*0.15) }}</span> INR</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-12 margin-top-15" >
                                        <button type="button" class="btn dark mt-ladda-btn ladda-button" data-style="zoom-in" id="addCredits">
                                            <span class="ladda-label"><i class="fa fa-plus"></i> Buy now</span>
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-badge font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Credit Transactions</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table-100 table table-striped table-bordered table-hover table-checkable order-column responsive" id="credits_purchase_table">
                                <thead>
                                <tr>

                                    <th class="all"> Credits </th>
                                    <th class="min-tablet"> Cost per credit </th>
                                    <th class="all"> Amount </th>
                                    <th class="min-tablet"> Status </th>
                                    <th class="min-tablet"> Date </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>

@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/counterup/jquery.counterup.js') !!}
    {!! HTML::script('admin/global/plugins/counterup/jquery.waypoints.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
    {!! HTML::script('https://checkout.razorpay.com/v1/checkout.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-toastr/toastr.js') !!}
    {!! HTML::script("admin/global/plugins/froiden-helper/helper.js?v=1.2") !!}
    <script>
        function load_dataTable(){
            var table = $('#credits_purchase_table');

            // begin first table
            table.DataTable({
                "sAjaxSource": "{{ route('gym-admin.credits.ajax-create') }}",
                bDestroy:true,
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  }
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                responsive: {
                    details: {
                        renderer: function ( api, rowIdx ) {
                            // Select hidden columns for the given row
                            var data = api.cells( rowIdx, ':hidden' ).eq(0).map( function ( cell ) {
                                var header = $( api.column( cell.column ).header() );

                                return '<tr>'+
                                        '<td>'+
                                        header.text()+':'+
                                        '</td> '+
                                        '<td>'+
                                        api.cell( cell ).data()+
                                        '</td>'+
                                        '</tr>';
                            } ).toArray().join('');

                            return data ?
                                    $('<table/>').append( data ) :
                                    false;
                        }
                    }
                },
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "previous":"Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ]
            });
        }
    </script>

    <script>

        $('#credits').keyup(function () {
            var costPerCredit = 0.20;
            var credits = $(this).val();
            var subTotal = parseInt(credits)*costPerCredit;
            var tax = 0.15;
            var taxAmount = parseFloat(subTotal*tax);
            var grandTotal = parseFloat(subTotal+taxAmount).toFixed(2);

            $('.credit-sub-total').html(parseFloat(subTotal).toFixed(2));
            $('.credit-grand-total').html(grandTotal);
        });

        $('#addCredits').click(function(){
            var toastrOptions = toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            var credits  = $('#credits').val();
            if(credits != ''){
                if(credits < 1000) {
                    $.showToastr('You have to buy minimum 1000 SMS credits', 'error', toastrOptions);
                    return false;
                } else if(isNaN(credits)) {
                    $.showToastr('Please enter valid credit amount', 'error', toastrOptions);
                    return false;
                }

                bootbox.confirm({
                    message: "Do you want to add "+credits+" credits to your wallet",
                    buttons: {
                        confirm: {
                            label: "Yes",
                            className: "btn-primary"
                        }
                    },
                    callback: function(result){
                        if(result){
                            $.easyAjax({
                                'type':'POST',
                                'data':{'credits':credits,_token:'{{csrf_token()}}'},
                                'url':'{{route('gym-admin.credits.confirm-add')}}',
                                success:function (res) {
                                    if(res.status == 'success')
                                    {
                                        if(sameOrigin){
                                            payCredits(res.payment_id,res.amount);
                                        }
                                        else {
                                            window.parent.postMessage({paymentId: res.payment_id, amount: res.amount},'file://');
                                        }
                                    }
                                }
                            })

                        }
                        else {
                            console.log('cancel');
                        }
                    }
                })
            }
            else{
                $.showToastr('Enter number of SMS credits to purchase', 'error', toastrOptions);
            }
        });
    </script>
    <script>
        function payCredits(id,amount) {
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": amount, //in paise
                "name": "FITSIGMA",
                "description": "SMS CREDITS",
                "image": "{{ asset('ace/images/icon.png') }}",
                "handler": function (response) {
                    confirmRazorpayPayment(response.razorpay_payment_id);
                },
                "modal": {
                    "ondismiss": function () {
                        goToByScroll('confirmMessage');
                        $('#confirmMessage').html('<div class="row"><div class="col-md-10"><h3 class="text-danger">Booking not successful !!</h3> <h4>Payment cancelled by user</h4></div></div>');
                    }
                },
                "prefill": {
                    "name": "{{ $user->first_name }} {{ $user->last_name }}",
                    "email": "{{ $user->email }}"
                },
                "notes": {
                    "booking_id": id //booking ID
                }
            };
            var rzp1 = new Razorpay(options);

            rzp1.open();
        }

        function confirmRazorpayPayment(id) {
            $.easyAjax({
                type:'POST',
                url:'{{route('gym-admin.credits.confirmRazorpayPayment')}}',
                data: {paymentId: id,_token:'{{csrf_token()}}'},
                success: function (res) {
                    if(res.status == 'success')
                    {
                        load_dataTable();
                    }
                }
            })
        }

        /*listen cordova app payment id*/
        window.addEventListener("message", receiveMessage, false);

        function receiveMessage(event)
        {
            var origin = event.origin || event.originalEvent.origin; // For Chrome, the origin property is in the event.originalEvent object.
//            console.log('origin: '+origin+' '+'payid: '+event.data.paymentId);
            if (origin !== "file://" || typeof event.data.paymentId === "undefined")
            {
                return;
            }
//            console.log(event.data.paymentId);
            confirmRazorpayPayment(event.data.paymentId);
        }
    </script>
    <script>
        $(document).ready(function(){
            load_dataTable();
        });
    </script>
@stop