@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
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
                <span>Offers</span>
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
                                <i class="icon-present font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> GYM-OFFERS</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a id="sample_editable_1_new" onclick="createModal()" class="btn sbold dark"> Add New
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover table-checkable order-column" id="gym_clients">
                                <thead>
                                <tr>
                                    <th class="max-desktop"> Title </th>
                                    <th class="desktop"> Valid From </th>
                                    <th class="desktop"> Valid Till </th>
                                    <th class="desktop"> Original Price </th>
                                    <th class="desktop"> Discounted Price </th>
                                    <th class="desktop"> Offer For </th>
                                    <th class="desktop"> Status </th>
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

    <div class="modal fade bs-modal-md in" id="gymOfferModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::script('admin/pages/scripts/components-date-time-pickers.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!! HTML::script('admin/global/plugins/bootbox/bootbox.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    <script>

        var table = $('#gym_clients');

        // begin first table

        table.dataTable({
            responsive: true,
            "sAjaxSource":"{{ route('gym-admin.offers.ajax_create') }}",
            "aoColumns": [
                { 'sClass': 'center', "bSortable": true, "width": "20%", "bSearchable": true  },
                { 'sClass': 'center', "bSortable": true,  "bSearchable": true  },
                { 'sClass': 'center', "bSortable": true,  "bSearchable": true  },
                { 'sClass': 'center', "bSortable": true,  "bSearchable": true  },
                { 'sClass': 'center', "bSortable": true,  "bSearchable": true  },
                { 'sClass': 'center', "bSortable": true,  "bSearchable": true  },
                {'sClass': 'center', "bSortable": true, "bSearchable": true   },
                { 'sClass': 'center', "bSortable": false, "width": "10%",  "bSearchable": true }
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


        function createModal(){
            var url = '{{route('gym-admin.offers.create')}}';
            $('#modelHeading').html('Add Offer');
            $.ajaxModal("#gymOfferModal", url);
        }
    </script>
    <script>
        function editOffer(id)
        {
            var show_url = '{{route('gym-admin.offers.show',['#id'])}}';
            var url = show_url.replace('#id',id);
            $('#modelHeading').html('Edit Offer');
            $.ajaxModal('#gymOfferModal',url);
        }
    </script>
    <script>
        function Delete(id)
        {
            var offerID = id;

            bootbox.confirm({
                message: "Do you want to delete this offer?",
                buttons: {
                    confirm: {
                        label: "Yes",
                        className: "btn-primary"
                    }
                },
                callback: function(result){
                    if(result){

                        var url = '{{route('gym-admin.offers.destroy',':id')}}';
                        url = url.replace(':id',offerID);

                        $.easyAjax({
                            url: url,
                            type: "DELETE",
                            data: {offerID: offerID,_token: '{{ csrf_token() }}'},
                            success: function(){
                                $('#offer_'+id).fadeOut(500);

                            }
                        });
                    }
                    else {
                        console.log('cancel');
                    }
                }
            })
        }
    </script>
@stop