@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/bootstrap-daterangepicker/daterangepicker.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.dataTables.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') !!}
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
                <span>Attendance Report</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            {{--Info Section --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="m-heading-1 border-green m-bordered">
                        <h3>Attendance Report</h3>

                        <p>This report section provides you features like: </p>
                        <ul>
                            <li>List the Defaulters.</li>
                            <li>Show the attendance of the clients.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="portlet light portlet-fit">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-clock-o font-red"></i><span class="caption-subject font-red bold uppercase">Attendance Report</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-5">
                            {!! Form::open(['id'=>'createAttendanceReport','class'=>'ajax-form']) !!}
                            <div class="form-body">
                                <div class="form-group form-md-line-input ">
                                    <select class="bs-select form-control" data-live-search="true" data-size="8"
                                            name='type' id="type">
                                        <option value="">Select a type</option>
                                        <option value="defaulter">Defaulter</option>
                                        <option value="attendance">Attendance</option>
                                    </select>
                                    <label for="title">Select Booking Type</label>
                                    <span class="help-block"></span>
                                </div>
                                <div id="defaulte_div" style="display: none">
                                    <div class="form-group form-md-line-input form-md-floating-label" id="input_days">
                                        <input type="text" class="form-control" id="days" name="days">
                                        <label for="form_control_1">Days</label>
                                        <span class="help-block">Please enter days .</span>
                                    </div>
                                    <div class="form-group">
                                        <div id="reportrange" class="btn default">
                                            <i class="fa fa-calendar"></i> &nbsp;
                                            <span id="date">{{\Carbon\Carbon::now('Asia/Calcutta')->toFormattedDateString()}}
                                                - {{\Carbon\Carbon::now('Asia/Calcutta')->toFormattedDateString()}} </span>
                                            <b class="fa fa-angle-down"></b>
                                        </div>
                                    </div>
                                </div>
                                <div id="attendance_div" style="display: none">
                                    <div class="form-group form-md-line-input ">
                                        <select class="bs-select form-control" data-live-search="true" data-size="8"
                                                name='sub_category' id="subcategory">
                                            <option value="">Select a Category</option>
                                            @foreach($subcategories as $key=>$subcat)
                                                <option value="{{ $subcat->id }}">{{ ucwords($subcat->Category->name) }}</option>
                                            @endforeach
                                        </select>
                                        <label for="title">Select Catergory</label>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="row">
                                        <div class="form-group form-md-line-input col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control timepicker timepicker-no-seconds"
                                                       placeholder="Start Time" name="start_time" id="start_time">
                                                                <span class="input-group-btn">
                                                                    <button class="btn default" type="button">
                                                                        <i class="fa fa-clock-o"></i>
                                                                    </button>
                                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control timepicker timepicker-no-seconds"
                                                       placeholder="End Time" name="end_time" id="end_time">
                                                                <span class="input-group-btn">
                                                                    <button class="btn default" type="button">
                                                                        <i class="fa fa-clock-o"></i>
                                                                    </button>
                                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="reportrange_attendance" class="btn default">
                                            <i class="fa fa-calendar"></i> &nbsp;
                                            <span id="date_attendance">{{\Carbon\Carbon::now('Asia/Calcutta')->toFormattedDateString()}}
                                                - {{\Carbon\Carbon::now('Asia/Calcutta')->toFormattedDateString()}} </span>
                                            <b class="fa fa-angle-down"></b>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-actions" style="margin-top: 70px">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn dark mt-ladda-btn ladda-button"
                                                    data-style="zoom-in" id="save-form">
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
                                    <i class="widget-thumb-icon bg-white-opacity fa fa-users"></i>

                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle font-white">Total</span>
                                        <span class="widget-thumb-body-stat counter" id="count" data-counter="counterup"
                                              data-value="">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" id="attendanceDataTable" style="display: none">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-clock font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Attendance</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table-100 table table-striped table-bordered table-hover table-checkable order-column responsive"
                                   id="attendance">
                                <thead>
                                <tr>
                                    <th class="all"> Name</th>
                                    <th class="min-tablet"> Email</th>
                                    <th class="min-tablet"> Mobile</th>
                                    <th class="min-tablet"> Gender</th>
                                    <th class="min-tablet"> Check In</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>

            <div class="row" id="attendanceDefaulterDataTable" style="display: none">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-clock font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Attendance Defaulters</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table-100 table table-striped table-bordered table-hover table-checkable order-column responsive"
                                   id="defaulterTable">
                                <thead>
                                <tr>
                                    <th class="all"> Name</th>
                                    <th class="min-tablet"> Email</th>
                                    <th class="min-tablet"> Mobile</th>
                                    <th class="min-tablet"> Gender</th>
                                    <th class="min-tablet">Action</th>
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
    {!! HTML::script('admin/global/plugins/select2/select2.js') !!}
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
    {!! HTML::script('admin/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') !!}
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
        $('#reportrange_attendance').daterangepicker({
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
                    $('#reportrange_attendance span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
        );

        $('.timepicker-default').timepicker({
            autoclose: true,
            showSeconds: true,
            minuteStep: 1
        });

        $('.timepicker-no-seconds').timepicker({
            autoclose: true,
            minuteStep: 5,
            defaultTime: false
        });
        $('.timepicker').parent('.input-group').on('click', '.input-group-btn', function (e) {
            e.preventDefault();
            $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
        });
    </script>
    <script>
        $('#type').change(function () {
            var type = $("#type option:selected").val();
            if (type == 'defaulter') {
                $('#defaulte_div').css('display', 'block');
                $('#attendance_div').css('display', 'none');
            } else {
                $('#defaulte_div').css('display', 'none');
                $('#attendance_div').css('display', 'block');
            }
        })
    </script>

    <script>
        $('#save-form').click(function () {
            var type = $("#type option:selected").val();
            if (type == 'defaulter') {
                var dateRange = $('#reportrange span').html();
                var days = $('#days').val();
                if (days != '') {
                    $.easyAjax({
                        url: '{{route('gym-admin.attendance-report.store')}}',
                        container: '#createAttendanceReport',
                        type: "POST",
                        data: {date_range: dateRange, days: days, type: type, _token: '{{csrf_token()}}'},
                        success: function (res) {
                            if (res.status = 'success') {
                                $('#input_days').removeClass('has-error');
                                $('#count').attr('data-value', res.total);
                                $('#heading').html(res.report);
                                $('#easyStats').css('display', 'block');
                                $('#attendanceDefaulterDataTable').css('display', 'block');
                                load_data_table(res.days, res.start_date, res.end_date);
                                $('.counter').counterUp();
                            }
                        }
                    });
                } else {
                    $('#input_days').addClass('has-error');
                    $.showToastr('Please Enter Days', 'error');
                }
            }
            if (type == "attendance") {
                var dateRangeAttendance = $('#reportrange_attendance span').html();
                var start_time = $('#start_time').val();
                var end_time = $('#end_time').val();
                var cat = $("#subcategory option:selected").val();
                if ( cat != '') {
                    $.easyAjax({
                        url: '{{route('gym-admin.attendance-report.store')}}',
                        container: '#createAttendanceReport',
                        type: "POST",
                        data: {
                            date_range: dateRangeAttendance,
                            start_time: start_time,
                            end_time: end_time,
                            cat: cat,
                            type: type,
                            _token: '{{csrf_token()}}'
                        },
                        success: function (res) {
                            if (res.status = 'success') {
                                $('#input_days').removeClass('has-error');
                                $('#count').attr('data-value', res.total);
                                $('#heading').html(res.report);
                                $('#easyStats').css('display', 'block');
                                $('#attendanceDataTable').css('display', 'block');
                                load_table(res.cat, res.start_date, res.end_date, res.start_time, res.end_time);
                                $('.counter').counterUp();
                            }
                        }
                    });
                } else {
                    $.showToastr('Please Complete Form', 'error');
                }
            }

        });
    </script>
    <script>
        function load_data_table(id, s, e) {
            var table = $('#defaulterTable');
            var url = '{{route('gym-admin.attendance-report.ajax-create',['#id','#s','#e'])}}';
            url = url.replace('#id', id);
            url = url.replace('#s', s);
            url = url.replace('#e', e);
            // begin first table
            table.DataTable({
                "sAjaxSource": url,
                bDestroy: true,
                "aoColumns": [
                    {'sClass': 'center', "bSortable": true},
                    {'sClass': 'center', "bSortable": true},
                    {'sClass': 'center', "bSortable": true},
                    {'sClass': 'center', "bSortable": true},
                    {'sClass': 'center', "bSortable": false}
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                responsive: {
                    details: {
                        renderer: function (api, rowIdx) {
                            // Select hidden columns for the given row
                            var data = api.cells(rowIdx, ':hidden').eq(0).map(function (cell) {
                                var header = $(api.column(cell.column).header());

                                return '<tr>' +
                                        '<td>' +
                                        header.text() + ':' +
                                        '</td> ' +
                                        '<td>' +
                                        api.cell(cell).data() +
                                        '</td>' +
                                        '</tr>';
                            }).toArray().join('');

                            return data ?
                                    $('<table/>').append(data) :
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
                        "previous": "Prev",
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
        function load_table(t, s, e, st, et) {
            var table = $('#attendance');
            var url = '{{route('gym-admin.attendance-report.ajax-create-attendance',['#id','#s','#e','#st','#et'])}}';
            url = url.replace('#id', t);
            url = url.replace('#s', s);
            url = url.replace('#e', e);
            url = url.replace('#st', st);
            url = url.replace('#et', et);
            // begin first table
            table.DataTable({
                "sAjaxSource": url,
                bDestroy: true,
                "aoColumns": [
                    {'sClass': 'center', "bSortable": true},
                    {'sClass': 'center', "bSortable": true},
                    {'sClass': 'center', "bSortable": true},
                    {'sClass': 'center', "bSortable": true},
                    {'sClass': 'center', "bSortable": true}
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                responsive: {
                    details: {
                        renderer: function (api, rowIdx) {
                            // Select hidden columns for the given row
                            var data = api.cells(rowIdx, ':hidden').eq(0).map(function (cell) {
                                var header = $(api.column(cell.column).header());

                                return '<tr>' +
                                        '<td>' +
                                        header.text() + ':' +
                                        '</td> ' +
                                        '<td>' +
                                        api.cell(cell).data() +
                                        '</td>' +
                                        '</tr>';
                            }).toArray().join('');

                            return data ?
                                    $('<table/>').append(data) :
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
                        "previous": "Prev",
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