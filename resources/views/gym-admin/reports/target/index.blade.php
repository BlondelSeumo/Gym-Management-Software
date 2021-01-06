@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.dataTables.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
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
                <span>Target Report</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-heading-1 border-green m-bordered">
                        <h3>Target Report</h3>
                        <p>Well you had made some targets and we help you to track them. </p>
                        <p>This section provides the reports on the target that you have made.</p>
                        <ul>
                            <li>Memberships</li>
                            <li>Sale</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet light portlet-fit">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-target font-red"></i><span class="caption-subject font-red bold uppercase">Select Target</span></div>


                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-5">
                            {!! Form::open(['id'=>'createTargetReport','class'=>'ajax-form']) !!}
                            <div class="form-body">
                                <div class="form-group form-md-line-input ">
                                    <select class="bs-select form-control" data-live-search="true" data-size="8" name="target" id="target">
                                        @if(count($targets)>0)
                                            @foreach($targets as $target)
                                                <option value="{{$target->id}}">{{$target->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="title">Select Target</label>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-actions" style="margin-top: 70px">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn dark mt-ladda-btn ladda-button" data-style="zoom-in" id="save-form">
                                                <span class="ladda-label"><i class="icon-arrow-up"></i> Submit</span>
                                            </button>
                                            <button type="reset" class="btn default">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-4" id="easyStats" style="display: none">
                            <div class="easy-pie-chart">
                                <div class="number transactions" id="users_percent" data-percent="0">
                                    <span id="spanData"></span>% </div>
                                <a class="title" href="javascript:;" id="graphTitle">

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" id="targetDataTable" style="display: none">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-target font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Target Details</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table-100 table table-striped table-bordered table-hover table-checkable order-column responsive" id="targets_table">
                                <thead>
                                <tr>
                                    <th class="all"> Name </th>
                                    <th class="min-tablet"> Membership </th>
                                    <th class="min-tablet"> Payment Amount </th>
                                    <th class="min-tablet"> Date </th>
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
    {!! HTML::script('admin/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}

    <script>
        $('#save-form').click(function(){
            var type = $('#target').val();
            if(type == ''){
                $.showToastr('Please Select a Type','error');
            }else {
                $.easyAjax({
                    url:'{{route('gym-admin.target-report.store')}}',
                    container:'#createTargetReport',
                    type:"POST",
                    data:$('#createTargetReport').serialize(),
                    success:function(res){
                        if(res.status == 'success'){
                            $('#users_percent').attr('data-percent',res.data.percent);
                            $('#spanData').html(res.data.percent);
                            $('#graphTitle').html(' '+res.data.report+' &nbsp;<i class="icon-arrow-right"></i>');
                            $('#easyStats').css('display','block');
                            $('#targetDataTable').css('display','block');
                            load_data_table(res.data.target_id);


                            $('.easy-pie-chart .number.transactions').easyPieChart({
                                animate: 3000,
                                size: 150,
                                lineWidth: 10,
                                barColor: '#e43a45'
                            });


                                $('.easy-pie-chart .number').each(function() {
                                    $(this).data('easyPieChart').update(res.percent);
                                });
                        }
                    }
                });
            }

        });
    </script>
    <script>
        function load_data_table(id) {
            var table = $('#targets_table');
               var url = '{{route('gym-admin.target-report.ajax-create',['#id'])}}';
                url = url.replace('#id',id);
            // begin first table
            table.DataTable({
                "sAjaxSource": url,
                bDestroy:true,
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  }
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
@stop