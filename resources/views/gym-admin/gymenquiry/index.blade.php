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
                <span>Enquiry</span>
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
                                <i class="icon-earphones-alt font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> GYM ENQUIRES</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a id="sample_editable_1_new" href="{{route('gym-admin.enquiry.create')}}" class="btn sbold dark"> Add New
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
                            <table style="width: 100%" class="table table-striped table-bordered table-hover table-checkable order-column" id="gym_enquiry">
                                <thead>
                                <tr>
                                    <th class="max-desktop"> Name </th>
                                    <th class="desktop"> Mobile </th>
                                    <th class="desktop"> Email </th>
                                    <th class="desktop"> Last Follow up </th>
                                    <th class="desktop"> Next Follow up </th>
                                    <th class="desktop"> Follow Up </th>
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
    {{--Modal Start--}}

    <div class="modal fade bs-modal-md in" id="gymEnquiryModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    {{--End Modal--}}
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
            "ajax": "{{route('gym-admin.enquiry.create.ajax')}}",
            "aoColumns": [
                { 'sClass': 'center', "bSortable": true, "searchable": true  },
                { 'sClass': 'center', "bSortable": true, "searchable": true  },
                { 'sClass': 'center', "bSortable": true, "searchable": true  },
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
                [4, "desc"]
            ] // set first column as a default sort by asc
        });

        function deleteModal(id){
            var url_modal = '{{route('gym-admin.enquiry.modal',[':id'])}}';
            var url = url_modal.replace(':id',id);
            $('#modelHeading').html('Remove Enquiry');
            $.ajaxModal("#gymEnquiryModal", url);
        }

        enquiryTable.on('click', '.new-follow-up', function () {
            var enquiryId = $(this).data('enquiry-id');
            var url_modal = '{{route('gym-admin.enquiry.follow-modal',[':id'])}}';
            var url = url_modal.replace(':id',enquiryId);
            $('#modelHeading').html('Follow Up');
            $.ajaxModal("#gymEnquiryModal", url);
        });

        enquiryTable.on('click', '.view-follow-up', function () {
            var enquiryId = $(this).data('enquiry-id');
            var url_modal = '{{route('gym-admin.enquiry.view-follow-modal',[':id'])}}';
            var url = url_modal.replace(':id',enquiryId);
            $('#modelHeading').html('Follow Up');
            $.ajaxModal("#gymEnquiryModal", url);
        });

        $('#gymEnquiryModal').on('click', '#add-follow-up', function(){
            $.easyAjax({
                url: '{{route('gym-admin.enquiry.saveFollowUp')}}',
                container:'#followUpForm',
                type: "POST",
                data:$('#followUpForm').serialize(),
                success: function (response) {
                    if(response.status == 'success'){
                        $('#gymEnquiryModal').modal('hide');
                        table._fnDraw();
                    }
                }
            })
        });

        $('#gymEnquiryModal').on('click', '#removeEnquiry', function(){
            var enquiryId = $(this).data('enquiry-id');
            var url = '{{route('gym-admin.enquiry.destroy',[':id'])}}';
            url = url.replace(':id',enquiryId);
            $.easyAjax({
                url: url,
                container:'.modal-body',
                data: { '_token': '{{ csrf_token() }}' },
                type: "DELETE",
                success: function (response) {
                    if(response.status == 'success'){
                        $('#gymEnquiryModal').modal('hide');
                        table._fnDraw();
                    }
                }
            });
        });
    </script>
@stop