@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
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
                <span>Payments</span>
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
                                <i class=" fa {{ $gymSettings->currency->symbol }} font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Payments</span>
                            </div>
                            <div class="col-md-2 col-md-offset-7 col-xs-12" >
                                    <select id="records" class="form-control">
                                        <option value="all">Showing All Payments</option>
                                        <option value="archive">Show Deleted Payments</option>
                                    </select></div>
                            <div class="actions col-sm-2 col-xs-12">

                                <a href="{{route('gym-admin.membership-payment.create')}}" id="add_payment" class="btn dark"> add <span class="hidden-xs">payment</span>
                                    <i class="fa fa-plus"></i>
                                </a>

                            </div>
                        </div>
                        <div class="portlet-body">
                        <div id="allRecord">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column table-100" id="mem-payments">

                                <thead>

                                <tr>
                                    <th  class="max-desktop"> Name </th>
                                    <th class="desktop"> Amount </th>
                                    <th class="desktop"> Source </th>
                                    <th class="desktop"> Payment Date </th>
                                    <th class="desktop"> Payment ID </th>
                                    <th class="desktop"> Payment Type </th>
                                    <th class="desktop"> Actions</th>
                                </tr>
                                </thead>
                            </table></div>
                            <div id="deletedRecord">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column table-100" id="mem-payments_deleted">

                                <thead>

                                <tr>
                                    <th  class="max-desktop"> Name </th>
                                    <th class="desktop"> Amount </th>
                                    <th class="desktop"> Source </th>
                                    <th class="desktop"> Payment Date </th>
                                    <th class="desktop"> Payment ID </th>
                                    <th class="desktop"> Payment Type </th>
                                    <th class="desktop"> Deleted On </th>
                                </tr>
                                </thead>
                            </table>
                            </div>

                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>

    {{--Model--}}

    <div class="modal fade bs-modal-md in" id="gymPaymemtModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="modal fade bs-modal-md in" id="receiptModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{--Model End--}}
@stop

@section('footer')
    {!! HTML::script('admin/global/scripts/datatable.js') !!}
    {!! HTML::script('admin/pages/scripts/table-datatables-managed.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/datatables.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/bootbox/bootbox.min.js') !!}
    <script>
        jQuery(document).ready(function() {
            load_dataTable();
            $("#deletedRecord").hide();
        });
        $("#records").change(function () {
            var records = $("#records").val();
            if(records == 'all')
            {
                load_dataTable();
                $("#allRecord").show();
                $("#deletedRecord").hide();
            }
            else
            {
                $("#deletedRecord").show();
                $("#allRecord").hide();
                loaddeleted_dataTable();
            }

        })


        function loaddeleted_dataTable()
        {
            var table = $('#mem-payments_deleted');
            // begin first table
            table.dataTable({
                responsive: true,
                "sAjaxSource": "{{ route('gym-admin.membership-payment.ajax-create-deleted') }}",
                bDestroy:true,
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true, "width":"20%"  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  }
                ],
                "order": [[ 5, "desc" ]],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
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
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "previous":"Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "pagingType": "bootstrap_full_number"
            });
        }


        function load_dataTable()
        {
            var table = $('#mem-payments');
            // begin first table
            table.dataTable({
                responsive: true,
                "sAjaxSource": "{{ route('gym-admin.membership-payment.ajax-create') }}",
                bDestroy:true,
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true, "width":"20%"  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": false }
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
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
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "previous":"Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "pagingType": "bootstrap_full_number",
                "order": [
                    [5, "desc"]
                ] // set first column as a default sort by asc

            });
        }

    </script>
    <script>
        $('#mem-payments').on('click','.remove-payment',function(){
           var id = $(this).data('payment-id');
            bootbox.confirm({
                message: "Do you want to delete this payment?",
                buttons: {
                    confirm: {
                        label: "Yes",
                        className: "btn-primary"
                    }
                },
                callback: function(result){
                    if(result){

                        var url = '{{route('gym-admin.membership-payment.destroy',':id')}}';
                        url = url.replace(':id',id);

                        $.easyAjax({
                            url: url,
                            type: "DELETE",
                            data: {id: id,_token: '{{ csrf_token() }}'},
                            success: function(){
                                load_dataTable();
                            }
                        });
                    }
                    else {
                        console.log('cancel');
                    }
                }
            })
        });


        $('#mem-payments').on('click','.view-receipt', function () {
            var paymentId = $(this).data('payment-id');
            var show_url = '{{route('gym-admin.membership-payment.view-receipt',['#paymentId'])}}';
            var url = show_url.replace('#paymentId', paymentId);
            $('#modelHeading').html('Select Time');
            $.ajaxModal("#receiptModal", url);
        });

        $('#mem-payments').on('click','.email-receipt', function () {
            var paymentId = $(this).data('payment-id');
            var url_update = '{{route('gym-admin.membership-payment.email-receipt',[':id'])}}';
            var url = url_update.replace(':id',paymentId);
            $.easyAjax({
                url: url,
                type: 'GET',
                data: {paymentId: paymentId },
                success: function(response){
                    $('#payment_for_area').html(response.data);
                }
            })
        });
    </script>
@stop