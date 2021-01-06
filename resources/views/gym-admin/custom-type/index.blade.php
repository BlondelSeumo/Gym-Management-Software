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
                <span>Custom Payments Type</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title col-xs-12">
                            <div class="caption col-sm-10 col-xs-12">
                                <i class="icon-present font-red"></i><span class="caption-subject font-red bold uppercase">Custom Payment Type</span>
                            </div>

                            <div class="actions col-sm-2 col-xs-12">

                                <a href="javascript:;" class="btn dark" id="addType"> add <span class="hidden-xs"> New</span>
                                    <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>
                        <div class="portlet-body">

                            <table class="table table-striped table-bordered table-hover table-checkable order-column responsive" id="custom_type_table">
                                <thead>
                                <tr>
                                    <th class="all"> Name </th>
                                    <th class="min-tablet"> Action </th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>

    {{--Modal Start--}}

    <div class="modal fade bs-modal-md in" id="customTypeModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    {!! HTML::script('admin/global/plugins/bootbox/bootbox.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
    <script>
        var UIBootbox = function () {
            var o = function () {
                $(".delete-button").click(function () {
                    var memID = $(this).data('package-id');

                    bootbox.confirm({
                        message: "Do you want to delete this package?",
                        buttons: {
                            confirm: {
                                label: "Yes",
                                className: "btn-primary"
                            }
                        },
                        callback: function(result){
                            if(result){

                                var url = '{{route('gym-admin.package.destroy',':id')}}';
                                url = url.replace(':id',memID);

                                $.easyAjax({
                                    url: url,
                                    type: "DELETE",
                                    data: {memID: memID,_token: '{{ csrf_token() }}'},
                                    success: function(){
                                        $('#pkg-'+memID).fadeOut();
                                    }
                                });
                            }
                            else {
                                console.log('cancel');
                            }
                        }
                    })

                })
            };
            return {
                init: function () {
                    o()
                }
            }
        }();
        jQuery(document).ready(function () {
            UIBootbox.init()
        });
    </script>
    <script>
        function load_dataTable(){
            var table = $('#custom_type_table');

            // begin first table
            table.DataTable({
                "sAjaxSource": "{{ route('gym-admin.custom-type.ajax-create') }}",
                bDestroy:true,
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": false  }
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                responsive: {
                    details: {
                        renderer: function ( api, rowIdx ) {
                            // Select hidden columns for the given row
                            var data = api.cells( rowIdx, ':hidden' ).eq(0).map( function ( cell ) {
                                var header = $( api.column( cell.column ).header() );

                                return '<tr>'+
                                        '<td>'+
                                        header.text()+':'+
                                        '</td> '+
                                        '<td>'+
                                        api.cell( cell ).data()+
                                        '</td>'+
                                        '</tr>';
                            } ).toArray().join('');

                            return data ?
                                    $('<table/>').append( data ) :
                                    false;
                        }
                    }
                },
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
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
                ]
            });
        }
    </script>
    <script>
        $('#addType').click(function(){
            var url = '{{route('gym-admin.custom-type.create')}}';
            $('#modelHeading').html('Add Offer');
            $.ajaxModal("#customTypeModal", url);
        })
    </script>
    <script>
        $(document).ready(function(){
            load_dataTable();
        });
    </script>
@stop

