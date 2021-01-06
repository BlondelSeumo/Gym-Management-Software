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
                <a href="{{'gym-admin.dashboard.index'}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Billing History</span>
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
                                <i class="icon-list font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Billing History</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table  class="table-100 table table-striped table-bordered table-hover table-checkable order-column" id="gym_enquiry">
                                <thead>
                                <tr>
                                    <th class="max-desktop"> Plan </th>
                                    <th class="desktop"> Price paid </th>
                                    <th class="desktop"> Purchase ID </th>
                                    <th class="desktop"> Payment Method </th>
                                    <th class="desktop"> Plan Starts On </th>
                                    <th class="desktop"> Plan Ends On </th>
                                    <th class="desktop"> Purchased On </th>
                                    <th class="desktop"> Action </th>
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
    {!! HTML::script('admin/global/scripts/datatable.js') !!}
    {!! HTML::script('admin/pages/scripts/table-datatables-managed.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/datatables.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}

    <script>
        var enquiryTable = $('#gym_enquiry');

        var table = enquiryTable.dataTable({
            "responsive":true,
            "serverSide": true,
            "processing": true,
            "ajax": "{{route('gym-admin.ace-purchase.create')}}",
            "aoColumns": [
                { 'sClass': 'center', "bSortable": true,  "width": "20%" },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  }
            ],
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "processing": "<i class='fa fa-spinner faa-spin animated'></i> Processing",
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

//            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

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
            "order": [
                [6, "desc"]
            ] // set first column as a default sort by asc
        });

    </script>
@stop