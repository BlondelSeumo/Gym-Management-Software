@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/bootstrap-daterangepicker/daterangepicker.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
    {!! HTML::style('admin/global/plugins/morris/morris.css') !!}
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
                <span>Balance Report</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-heading-1 border-green m-bordered">
                        <h3>Balance Report</h3>
                        <p>This section provides you the report on your income and expense in provided date range</p>
                    </div>
                </div>
            </div>

            <div class="portlet light portlet-fit">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-balance-scale font-red"></i><span class="caption-subject font-red bold uppercase">Balance Report</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-5">
                            {!! Form::open(['id'=>'balanceReport','class'=>'ajax-form']) !!}
                            <div class="form-body">
                                <div class="form-group">
                                    <div id="balancerange" class="btn default">
                                        <i class="fa fa-calendar"></i> &nbsp;
                                        <span id="date">{{\Carbon\Carbon::now('Asia/Calcutta')->subMonths(6)->toFormattedDateString()}} - {{\Carbon\Carbon::now('Asia/Calcutta')->toFormattedDateString()}} </span>
                                        <b class="fa fa-angle-down"></b>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn dark mt-ladda-btn ladda-button" data-style="zoom-in" onclick="getData();return false;">
                                                <span class="ladda-label"><i class="icon-arrow-up"></i> Submit</span>
                                            </button>
                                            <button type="reset" class="btn default reset">Reset</button>
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
                                    <i class="widget-thumb-icon bg-white-opacity icon-present"></i>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">Total Income</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-green fa fa-money"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="1,293" id="totalIncome">{{ round($income, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">Total Expense</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-red fa fa-shopping-cart"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle"><i class="fa {{ $gymSettings->currency->symbol }}"></i></span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="1,293" id="totalExpense">{{ round($expense, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light portlet-fit ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Bar Chart</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="balance-chart" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/bootstrap-daterangepicker/moment.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-daterangepicker/daterangepicker.js') !!}
    {!! HTML::script('admin/global/plugins/morris/morris.min.js') !!}
    {!! HTML::script('admin/global/plugins/morris/raphael-min.js') !!}
    <script>
        var chart;
        $(document).ready(function() {
            chart = Morris.Bar({
                element: 'balance-chart',
                data: {!! $information !!},
                xkey: 'month',
                ykeys: ['income', 'expense'],
                labels: ['Income', 'GymExpense'],
                barColors:['#32c5d2', '#849394']
            });

            var startDate = moment().subtract('month', 6);
            var endDate = moment();
            $('#balancerange').daterangepicker({
                    opens: (App.isRTL() ? 'left' : 'right'),
                    startDate: startDate,
                    endDate: endDate,
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
                    $('#balancerange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );

            $('.reset').click(function() {
                var startDate = "{{\Carbon\Carbon::now('Asia/Calcutta')->subMonths(6)->toFormattedDateString()}}";
                var endDate = "{{\Carbon\Carbon::now('Asia/Calcutta')->toFormattedDateString()}}";
                var start_date = moment().subtract('month', 6);
                var end_date = moment();
                $('#date').text(startDate + ' - ' + endDate);
                $('#balancerange').daterangepicker({
                    startDate: start_date,
                    endDate: end_date
                });
            });
        });


        function getData() {
            var start = $('#balancerange').data('daterangepicker').startDate._d;
            var end = $('#balancerange').data('daterangepicker').endDate._d;
            var startDate = moment(start).format('Y-M-D');
            var endDate = moment(end).format('Y-M-D');

            $.easyAjax({
                type: "GET",
                url: "{{ route('gym-admin.balance-report.create') }}",
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function(response) {
                    chart.setData(JSON.parse(response.information));
                    $('#totalIncome').html(response.totalIncome);
                    $('#totalExpense').html(response.totalExpense);
                }
            });

        }
    </script>
@stop