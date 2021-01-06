@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/bootstrap-daterangepicker/daterangepicker.css') !!}
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
                <span>Booking Report</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            <div class="row">
                <div class="col-md-12">
                    <div class="m-heading-1 border-green m-bordered">
                        <h3>Subscription Report</h3>
                        <p>This report section provides you list of bookings according : </p>
                        <ul>
                            <li>All Types of Subscription</li>
                            <li>Only Memberships</li>
                            <li>Only Offers</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="portlet light portlet-fit">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-calendar font-red"></i><span class="caption-subject font-red bold uppercase">Subscription Report</span></div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-5">
                            {!! Form::open(['id'=>'createBookingReport','class'=>'ajax-form']) !!}
                            <div class="form-body">
                                <div class="form-group form-md-line-input ">
                                    <select class="bs-select form-control" data-live-search="true" data-size="8" name="booking_type" id="booking_type">
                                        <option value="all">All</option>
                                        <option value="membership">Memberships</option>
                                    </select>
                                    <label for="title">Select Booking Type</label>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <div id="reportrange" class="btn default">
                                        <i class="fa fa-calendar"></i> &nbsp;
                                        <span id="date">{{\Carbon\Carbon::now('Asia/Calcutta')->toFormattedDateString()}} - {{\Carbon\Carbon::now('Asia/Calcutta')->toFormattedDateString()}} </span>
                                        <b class="fa fa-angle-down"></b>
                                    </div>
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
                        <div class="col-md-4" id="easyStats" style="display: none;margin-top: 50px;margin-left: 20px">
                            <div class="widget-thumb widget-bg-color-dark-light text-uppercase margin-bottom-20 ">
                                <h4 class="widget-thumb-heading font-white" id="heading"></h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-white-opacity fa fa-inr"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle font-white">Total</span>
                                        <span class="widget-thumb-body-stat counter" id="count" data-counter="counterup" data-value="">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="bookingDataTable" style="display: none">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-calendar font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Subscriptions</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table-100 table table-striped table-bordered table-hover table-checkable order-column responsive" id="bookings_table">
                                <thead>
                                <tr>
                                    <th class="all"> Client Name </th>
                                    <th class="min-tablet"> Paid Amount </th>
                                    <th class="min-tablet"> Start Date </th>
                                    <th class="min-tablet"> Title </th>
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
    {!! HTML::script('admin/global/plugins/bootstrap-daterangepicker/moment.min.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-daterangepicker/daterangepicker.js') !!}
    {!! HTML::script('admin/global/plugins/counterup/jquery.counterup.js') !!}
    {!! HTML::script('admin/global/plugins/counterup/jquery.waypoints.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    <script>

        $('#reportrange').daterangepicker({
                    opens: (App.isRTL() ? 'left' : 'right'),
                    startDate: moment(),
                    endDate: moment(),
                    //minDate: '01/01/2012',
                    //maxDate: '12/31/2014',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        'Last 7 Days': [moment().subtract('days', 6), moment()],
                        'Last 30 Days': [moment().subtract('days', 29), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    buttonClasses: ['btn'],
                    applyClass: 'green',
                    cancelClass: 'default',
                    format: 'MM/DD/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Apply',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom Range',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
        );
    </script>

    <script>
        $('#save-form').click(function(){
            var dateRange = $('#reportrange span').html();
            var booking = $('#booking_type').val();
            if(booking == '')
            {
                $.showToastr('Please Select a Type','error');
            }else {
                $.easyAjax({
                    url:'{{route('gym-admin.booking-report.store')}}',
                    container:'#createBookingReport',
                    type:"POST",
                    data:{date_range:dateRange,booking_type:booking,_token:'{{csrf_token()}}'},
                    success:function(res){
                        if(res.status = 'success'){
                            $('#count').attr('data-value',res.total);
                            $('#heading').html(res.report);
                            $('#easyStats').css('display','block');
                            $('#bookingDataTable').css('display','block');
                            load_data_table(res.type,res.start_date,res.end_date);
                            $('.counter').counterUp();
                        }
                    }
                });
            }

        });
    </script>
    <script>
        function load_data_table(id,s,e){
            var table = $('#bookings_table');
            var url = '{{route('gym-admin.booking-report.ajax-create',['#id','#s','#e'])}}';
            url = url.replace('#id',id);
            url = url.replace('#s',s);
            url = url.replace('#e',e);
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