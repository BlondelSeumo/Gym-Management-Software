@extends('layouts.customer-app.basic')

@section('title')
    Fitsigma | Payments
@endsection

@section('CSS')
    {!! HTML::style('fitsigma_customer/bower_components/datatables/jquery.dataTables.min.css') !!}
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Payments</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Main Menu</li>
                <li>Payments</li>
                <li class="active">Payments</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0"><i class="fa {{$gymSettings->currency->symbol}}"></i> Payments</h3>
                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<a class="btn btn-sm btn-success waves-effect" href="javascript:;"><i class="zmdi zmdi-plus zmdi-hc-fw fa-fw"></i>Add Payment</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6"></div>--}}
                {{--</div>--}}
                <p class="text-muted m-b-30"></p>
                <div class="table-responsive">
                    <table id="paymentTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Source</th>
                            <th>Payment Date</th>
                            <th>Payment ID</th>
                            <th>Payment Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    {!! HTML::script('fitsigma_customer/bower_components/datatables/jquery.dataTables.min.js') !!}
    <script>
        var table = $('#paymentTable');
        table.dataTable({
            "responsive": true,
            "serverSide": true,
            "processing": true,
            "ajax": "{{ route('customer-app.payments.get-payment-data') }}",
            "aoColumns": [
                {'data': 'first_name', 'name': 'first_name'},
                {'data': 'payment_amount', 'name': 'payment_amount'},
                {'data': 'payment_source', 'name': 'payment_source'},
                {'data': 'payment_date', 'name': 'payment_date'},
                {'data': 'payment_id', 'name': 'payment_id'},
                {'data': 'payment_type', 'name': 'payment_type'},
                {'data': 'action', 'name': 'action'}
            ],
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "processing": "<i class='fa fa-spinner faa-spin animated'></i> Processing",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            }
        });
    </script>
@endsection