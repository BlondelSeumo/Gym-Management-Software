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
                <span>Users</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption col-sm-9 col-xs-12">
                                <i class="icon-user font-red"></i><span class="caption-subject font-red bold uppercase">Users</span>
                            </div>

                            <div class="actions col-sm-3 col-xs-12">

                                <a href="{{ route('gym-admin.users.create') }}" class="btn dark"> add user</span>
                                    <i class="fa fa-plus"></i>
                                </a>

                                <a href="{{ route('gym-admin.gymmerchantroles.index') }}" class="btn dark"> Manage Roles</span>
                                    <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>
                        <div class="portlet-body">

                                <table class="table table-striped table-bordered table-hover table-checkable order-column table-100" id="merchants">
                                    <thead>
                                    <tr role="row" class="heading">
                                        <th class="max-desktop">
                                            Username
                                        </th>
                                        <th class="desktop">
                                            Role
                                        </th>
                                        <th class="desktop">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>

                        </div>
                    </div>
                    <!-- End: life time stats -->
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

    <script>

        var table = $('#merchants');

        // begin first table
        table.dataTable({
            responsive: true,
            "serverSide": true,
            "processing": true,
            "ajax": "{{ route('gym-admin.users.ajax-create') }}",
            "aoColumns": [
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
                "processing": "<i class='fa fa-spinner faa-spin animated'></i> Processing",
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


            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",

            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        $('#merchants').on('click','.assign-role', function () {
            var id = $(this).data('user-id');
            var show_url = '{{route('gym-admin.users.assign-role-modal',['#id'])}}';
            var url = show_url.replace('#id', id);
            $('#modelHeading').html('Assign Role');
            $.ajaxModal("#reminderModal", url);
        });


        $('#merchants').on('click','.remove-user',function(){
            var id = $(this).data('user-id');
            bootbox.confirm({
                message: "Do you want to delete this user?",
                buttons: {
                    confirm: {
                        label: "Yes",
                        className: "btn-primary @if($userCount == 1) disabled @endif",
                        disabled: "true"
                    }
                },
                callback: function(result) {
                    var userCount = "{{ $userCount }}";
                    if(result && userCount > 1) {
                        var url = '{{route('gym-admin.users.destroy',':id')}}';
                        url = url.replace(':id',id);

                        $.easyAjax({
                            url: url,
                            type: "DELETE",
                            data: {id: id,_token: '{{ csrf_token() }}'},
                            success: function(){
                                load_dataTable();
                            }
                        });
                    } else {
                        console.log('cancel');
                    }
                }
            })
        });
    </script>
@stop