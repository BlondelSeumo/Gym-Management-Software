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
                <span>Payments Reminder History</span>
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
                                <i class=" fa fa-list font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Payments Reminder History</span>
                            </div>

                            <div class="actions col-sm-2 col-xs-12">

                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column table-100" id="payments-reminder">
                                <thead>
                                <tr>
                                    <th class="max-desktop" > Name </th>
                                    <th class="desktop"> Reminder Text</th>
                                    <th class="desktop"> Mobile</th>

                                    <th class="desktop"> Email</th>
                                    <th class="desktop"> Sent on </th>
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



    <div class="modal fade bs-modal-md in" id="reminderModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    {!! HTML::script('admin/global/plugins/bootstrap-maxlength/bootstrap-maxlength.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-maxlength.min.js') !!}

    <script>
        jQuery(document).ready(function() {

            load_dataTable();
        });
        function load_dataTable()
        {
            var table = $('#payments-reminder');
            // begin first table
            table.dataTable({
                responsive: true,
                "sAjaxSource": "{{ route('gym-admin.client-purchase.ajax-reminder-history') }}",
                bDestroy:true,
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true, "width":"20%"  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
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
                "pagingType": "bootstrap_full_number"
            });
        }

        $('#payments-reminder').on('click','.show-reminder', function () {
            var id = $(this).data('id');
            var show_url = '{{route('gym-admin.client-purchase.show-model',['#id'])}}';
            var url = show_url.replace('#id', id);
            $('#modelHeading').html('Select Time');
            $.ajaxModal("#reminderModal", url);
        });

    </script>

@stop