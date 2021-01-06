@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.dataTables.css') !!}
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
                <span>Pending Subscriptions</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="fa {{ $gymSettings->currency->symbol }} font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Pending Subscriptions</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                            </div>
                            <table  class="table table-100 table-striped table-bordered table-hover table-checkable order-column responsive" id="pending_table">
                                <thead>
                                <tr>
                                    <th class="all"> Client   </th>
                                    <th class="min-tablet"> Amount To Be Paid </th>
                                    <th class="min-tablet"> Remaining Amount </th>
                                    <th class="min-tablet"> Start Date </th>
                                    <th class="min-tablet"> Next payment </th>
                                    <th class="min-tablet"> Expires On </th>
                                    <th class="min-tablet"> Action </th>
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

    {{--Model--}}

@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
    <script>
        var table = $('#pending_table');
        table.dataTable({
            "responsive": true,
            "serverSide": true,
            "processing": true,
            "ajax": "{{ route('gym-admin.client-purchase.ajax-pending-subscription') }}",
            "aoColumns": [
                {'data': 'first_name', 'name': 'first_name'},
                {'data': 'amount_to_be_paid', 'name': 'amount_to_be_paid'},
                {'data': 'remaining', 'name': 'remaining'},
                {'data': 'date', 'name': 'date'},
                {'data': 'next_payment_date', 'name': 'next_payment_date'},
                {'data': 'expires_on', 'name': 'expires_on'},
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

        table.on('click','.remove-purchase',function(){
            var id = $(this).data('id');
            bootbox.confirm({
                message: "Do you want to delete this purchase?",
                buttons: {
                    confirm: {
                        label: "Yes",
                        className: "btn-primary"
                    }
                },
                callback: function(result){
                    if(result){

                        var url = '{{route('gym-admin.client-purchase.destroy',':id')}}';
                        url = url.replace(':id',id);

                        $.easyAjax({
                            url: url,
                            type: "DELETE",
                            success: function() {
                                table.fnDraw();
                            }
                        });
                    }
                }
            })
        });

    </script>

@stop