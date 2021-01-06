@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
@stop

@section('content')
    <div class="container-fluid"      >
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('gym-admin.dashboard.index') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Online Bookings</span>
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
                                <i class="icon-calendar font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Online Bookings</span>
                            </div>

                            <div class="actions col-sm-2 col-xs-12">

                                <a href="javascript:;" class="btn dark booking-fast-redeem"> Redeem <span class="hidden-xs">Booking</span>
                                    <i class="fa fa-check"></i>
                                </a>

                            </div>

                        </div>
                        <div class="portlet-body">
                            <table style="width: 100%" class="table table-striped table-bordered table-hover table-checkable order-column" id="gym-online-bookings">
                                <thead>
                                <tr>
                                    <th class="max-desktop"> Name </th>
                                    <th class="desktop"> Purchase </th>
                                    <th class="desktop"> Joining Date </th>
                                    <th class="desktop"> Time </th>
                                    <th class="desktop"> Price </th>
                                    <th class="desktop"> Status </th>
                                    <th class="desktop"> Booking ID </th>
                                    <th class="desktop"> Actions </th>
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
    {{--Modal Start--}}

    <div class="modal fade bs-modal-md in" id="bookingDetailModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">

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

    {{--End Modal--}}
@stop

@section('footer')
    {!! HTML::script('admin/global/scripts/datatable.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/datatables.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}

    <script>
        var table = $('#gym-online-bookings');

        // begin first table
        table.dataTable({
            responsive: true,
            "sAjaxSource":"{{ route('gym-admin.booking.create') }}",
            "aoColumns": [
                { 'sClass': 'center', "bSortable": true, "width": "20%", "bSearchable": true},
                { 'sClass': 'center', "bSortable": true, "bSearchable": true  },
                { 'sClass': 'center', "bSortable": true, "bSearchable": true  },
                { 'sClass': 'center', "bSortable": true, "bSearchable": true  },
                { 'sClass': 'center', "bSortable": true, "bSearchable": true  },
                { 'sClass': 'center', "bSortable": true, "bSearchable": true  },
                {'sClass': 'center', "bSortable": true, "bSearchable": true  },
                { 'sClass': 'center', "bSortable": false, "width": "10%", "bSearchable": true }
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

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });



        function deleteModal(id){
            var url_modal = '{{route('gym-admin.remove.modal',[':id'])}}';
            var url = url_modal.replace(':id',id);
            $('#modelHeading').html('BOOKING DETAIL');
            $.ajaxModal("#gymClientsModal", url);
        }

        $('#gym-online-bookings').on('click','.booking-detail-button', function () {
            var id = $(this).data('booking-id');
            var url_modal = '{{route('gym-admin.booking.show',[':id'])}}';
            var url = url_modal.replace(':id',id);
            $('#modelHeading').html('Booking Detail');
            $.ajaxModal("#bookingDetailModal", url);
        });

    </script>
    <script>
        $('#gym-online-bookings').on('click','.send-reminder', function () {
            var id = $(this).data('booking-id');
            $.easyAjax({
                url: '{{route('gym-admin.booking.send-reminder')}}',
                container:'#gym-online-bookings',
                type: "POST",
                data: {'id':id,'_token':'{{csrf_token()}}'}
            });
        });
    </script>
@stop