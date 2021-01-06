@extends('layouts.customer-app.basic')

@section('title')
    Fitsigma | Due Payments
@endsection

@section('CSS')
    {!! HTML::style('fitsigma_customer/bower_components/datatables/jquery.dataTables.min.css') !!}
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Due Payments</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Main Menu</li>
                <li>Payments</li>
                <li class="active">Due Payments</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0"><i class="fa {{$gymSettings->currency->symbol}}"></i> Payments</h3>
                <p class="text-muted m-b-30"></p>
                <div class="table-responsive">
                    <table id="duePaymentTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Purchase Amount</th>
                            <th>Remaining Amount</th>
                            <th>Discount</th>
                            <th>Payment Due Date</th>
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
        var table = $('#duePaymentTable');
        table.dataTable({
            "responsive": true,
            "serverSide": true,
            "processing": true,
            "ajax": "{{ route('customer-app.payments.get-due-payment-data') }}",
            "aoColumns": [
                {'data': 'first_name', 'name': 'first_name'},
                {'data': 'purchase_amount', 'name': 'purchase_amount'},
                {'data': 'remaining_amount', 'name': 'remaining_amount'},
                {'data': 'discount', 'name': 'discount'},
                {'data': 'due_date', 'name': 'due_date'}
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