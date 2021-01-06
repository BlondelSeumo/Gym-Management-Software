@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/select2/select2.css') !!}
    {!! HTML::style('admin/global/plugins/select2/select2-bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.dataTables.css') !!}
@stop

@section('content')
    <div class="container-fluid">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Target</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row widget-row">
                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">Total Targets</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-grid"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">Count</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$allCount}}">0</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>

                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">Completed Targets</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-green icon-badge"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">Count</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$allCompleted}}">0</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>

            </div>
            @if(count($targetsProgress) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption ">
                                    <span class="caption-subject font-dark bold uppercase">Target Status</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                @forelse($targetsProgress as $target)
                                    <div class="caption-subject bold font-grey-gallery uppercase">
                                        {{$target['name']}} ({{ round($target['percent'],2) }}%)</div>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100" style="width: {{$target['percent']}}%">
                                            <span class="sr-only"> {{$target['percent']}}% Complete </span>
                                        </div>
                                    </div>
                                @empty
                                    <h5>You don't have any target yet.</h5>
                                    <a class="btn dark" href="{{route('gym-admin.target.create')}}">Create A Target <i class="fa fa-arrow-right"></i> </a>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-target font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Targets</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a id="addTarget" href="{{route('gym-admin.target.create')}}" class="btn sbold dark"> Add New
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column responsive" id="targets_table">
                                <thead>
                                <tr>
                                    <th class="all"> Title </th>
                                    <th class="min-tablet"> Type </th>
                                    <th class="min-tablet"> Value </th>
                                    <th class="min-tablet"> End Date </th>
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

@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/counterup/jquery.counterup.js') !!}
    {!! HTML::script('admin/global/plugins/counterup/jquery.waypoints.min.js') !!}
{{--    {!! HTML::script('admin/global/scripts/datatable.js') !!}--}}
{{--    {!! HTML::script('admin/pages/scripts/table-datatables-managed.js') !!}--}}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
    <script>
    function load_dataTable(){
        var table = $('#targets_table');

    // begin first table
    table.DataTable({
    "sAjaxSource": "{{ route('gym-admin.target.ajax-create') }}",
        bDestroy:true,
    "aoColumns": [
    { 'sClass': 'center', "bSortable": true  },
    { 'sClass': 'center', "bSortable": true  },
    { 'sClass': 'center', "bSortable": true  },
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
    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
    "lengthMenu": [
    [5, 15, 20, -1],
    [5, 15, 20, "All"] // change per page values here
    ]
    });
    }
    </script>

    <script>
        $('#targets_table').on('click','.remove-target',function(){
            var id = $(this).data('id');
            bootbox.confirm({
                message: "Do you want to delete this target?",
                buttons: {
                    confirm: {
                        label: "Yes",
                        className: "btn-primary"
                    }
                },
                callback: function(result){
                    if(result){

                        var url = '{{route('gym-admin.target.destroy',':id')}}';
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
    </script>
    <script>
        $(document).ready(function(){
            load_dataTable();
        });
    </script>
@stop