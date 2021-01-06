@extends('layouts.customer-app.basic')

@section('title')
    Fitsigma | Subscription
@endsection

@section('CSS')
{!! HTML::style('fitsigma_customer/bower_components/datatables/jquery.dataTables.min.css') !!}
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Subscription</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Main Menu</li>
                <li class="active">Subscription</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0"><i class="fa {{$gymSettings->currency->symbol}}"></i> Subscription</h3>
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-sm btn-success waves-effect" href="{{ route('customer-app.manage-subscription.create') }}"><i class="zmdi zmdi-plus zmdi-hc-fw fa-fw"></i>Add Subscription</a>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <p class="text-muted m-b-30"></p>
                <div class="table-responsive">
                    <table id="subscriptionTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Membership</th>
                            <th>Payments</th>
                            <th>Start Date</th>
                            <th>Expires On</th>
                            <th>Status</th>
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
    var table = $('#subscriptionTable');
    table.dataTable({
        "responsive": true,
        "serverSide": true,
        "processing": true,
        "cache": false,
        "ajax": "{{ route('customer-app.manage-subscription.get-data') }}",
        "aoColumns": [
            {'data': 'membership', 'name': 'membership'},
            {'data': 'payments', 'name': 'payments'},
            {'data': 'date', 'name': 'date'},
            {'data': 'expires_on', 'name': 'expires_on'},
            {'data': 'status', 'name': 'status'},
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

    table.on('click','.view-subscription', function () {
        var id = $(this).data('pk');
        var redirectUrl = '{{ route('customer-app.manage-subscription.show', ['#id']) }}';
        var url = redirectUrl.replace('#id', id);
        $.ajaxModal('#customerShowModal', url);
    });

    table.on('click','.delete-subscription', function () {
        var id = $(this).data('pk');
        $('.modal-title').html('Delete Subscription');
        $('.modal-body').html('Do you want to delete subscription?');
        $('#customerDeleteModal').modal("show");
        $('#customerDeleteModal').find('#deleteModalBtn').off('click').on('click', function() {
            var redirectUrl = '{{ route('customer-app.manage-subscription.destroy', ['#id']) }}';
            var url = redirectUrl.replace('#id', id);
            $.easyAjax({
                type: 'DELETE',
                url: url,
                success: function () {
                    table.fnDraw();
                    $('#customerDeleteModal').modal("hide");
                }
            });
        });
    });

    {{--function deleteSubscription(id) {--}}
{{--//        console.log(id);--}}
        {{--$('.modal-title').html('Delete Subscription');--}}
        {{--$('.modal-body').html('Do you want to delete subscription?');--}}
        {{--$('#customerDeleteModal').modal("show");--}}
        {{--$('#customerDeleteModal').find('#deleteModalBtn').on('click', function() {--}}
            {{--console.log(id);--}}
            {{--var redirectUrl = '{{ route('customer-app.manage-subscription.destroy', ['#id']) }}';--}}
            {{--var url = redirectUrl.replace('#id', id);--}}
            {{--$.easyAjax({--}}
                {{--type: 'DELETE',--}}
                {{--url: url,--}}
                {{--success: function () {--}}
                    {{--table.fnDraw();--}}
                    {{--$('#customerDeleteModal').modal("hide");--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--}--}}
</script>
@endsection