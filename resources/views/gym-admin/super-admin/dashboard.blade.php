@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/morris/morris.css') !!}
    <style>
        .dashboard-filter {
            padding-right: 15px;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">

        <!-- BEGIN PAGE BREADCRUMBS -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Super Admin</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMBS -->
            @if($user->can('view_dashboard'))
            <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row widget-row">
                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                                <h4 class="widget-thumb-heading">Total Earnings</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-purple fa {{ $gymSettings->currency->symbol }}"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">{{ $gymSettings->currency->acronym }}</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $totalEarnings }}">0</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>
                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                                <h4 class="widget-thumb-heading">Monthly Income</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-blue fa {{ $gymSettings->currency->symbol }}"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">{{ $gymSettings->currency->acronym }}</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $currentMonthEarnings }}">0</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>
                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                                <h4 class="widget-thumb-heading">Total Due Payment</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-red fa {{ $gymSettings->currency->symbol }}"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">{{ $gymSettings->currency->acronym }}</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $duePayments }}">0</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>
                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                                <h4 class="widget-thumb-heading">Monthly Expense</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-green fa {{ $gymSettings->currency->symbol }}"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">{{ $gymSettings->currency->acronym }}</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $currentMonthExpense }}">0</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>
                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="dashboard-stat red-intense">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number" data-counter="counterup" data-value="{{ $branchCount }}"> 0 </div>
                                    <div class="desc"> Total Branch </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>

                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="dashboard-stat purple-soft">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number" data-counter="counterup" data-value="{{ $customerCount }}"> 0</div>
                                    <div class="desc"> Total Customer </div>
                                </div>

                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>

                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="dashboard-stat grey-mint">
                                <div class="visual">
                                    <i class="icon-earphones-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="number" data-counter="counterup" data-value="{{ $currentMonthEnquiries }}"> 0 </div>
                                    <div class="desc"> Monthly Enquiries </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>

                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="dashboard-stat green-soft">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number" data-counter="counterup" data-value="{{ $unpaidMembers }}"> 0 </div>
                                    <div class="desc"> Unpaid Members </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption ">
                                        <i class="fa fa-bar-chart font-dark"></i>
                                        <span class="caption-subject font-dark bold uppercase">Earning v/s Expense</span>
                                        <span class="caption-helper"></span>
                                        <div class="form-inline margin-top-10">
                                        <span class="dashboard-filter form-group">
                                            <select id="monthEarning" class="form-control">
                                                <option value="" disabled selected>Month</option>
                                                @foreach($monthName as $value => $month)
                                                    <option value="{{ $value }}">{{ $month }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                            <span class="dashboard-filter form-group">
                                            <select id="yearEarning" class="form-control">
                                                <option value="" disabled selected>Year</option>
                                                @foreach($years as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                            <span class="dashboard-filter form-group">
                                            <select id="branchEarning" class="form-control">
                                                <option value="" disabled selected>Branch</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->title }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                            <span class="dashboard-filter">
                                            <button type="button" class="earningExpense btn btn-primary">Submit</button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="earningExpenseChart" class="CSSAnimationChart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-bar-chart font-dark"></i>
                                        <span class="caption-subject font-dark bold uppercase">Client Registrations</span>
                                        <span class="caption-helper"></span>
                                        <div class="form-inline margin-top-10">
                                        <span class="dashboard-filter form-group">
                                            <select id="monthClient" class="form-control">
                                                <option value="" disabled selected>Month</option>
                                                @foreach($monthName as $value => $month)
                                                    <option value="{{ $value }}">{{ $month }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                            <span class="dashboard-filter form-group">
                                            <select id="yearClient" class="form-control">
                                                <option value="" disabled selected>Year</option>
                                                @foreach($years as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                            <span class="dashboard-filter form-group">
                                            <select id="branchClient" class="form-control">
                                                <option value="" disabled selected>Branch</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->title }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                            <span class="dashboard-filter">
                                            <button type="button" class="customerRegister btn btn-primary">Submit</button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="customerRegistrationChart" class="CSSAnimationChart"></div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-users font-dark"></i>
                                        <span class="caption-subject font-dark bold uppercase">Recent Customers</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                        <tr class="uppercase">
                                            <th> Name </th>
                                            <th> Email </th>
                                            <th> Branch Name </th>
                                            <th> Gender </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($recentCustomers as $recentCustomer)
                                            <tr>
                                                <td>
                                                    {{ ucwords($recentCustomer->first_name.' '.$recentCustomer->last_name) }} </td>
                                                <td>
                                                    {{ $recentCustomer->email }}
                                                </td>
                                                <td>
                                                    {{ $recentCustomer->title }} </td>
                                                <td>
                                                    @if($recentCustomer->gender == 'male')
                                                        <i class="fa fa-male"></i>
                                                        {{ ucwords($recentCustomer->gender) }}
                                                    @elseif($recentCustomer->gender == 'female')
                                                        <i class="fa fa-female"></i>
                                                        {{ ucwords($recentCustomer->gender) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No recent customer.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="fa fa-money font-dark"></i>
                                        <span class="caption-subject font-dark bold uppercase">Recent Payments</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                        <tr class="uppercase">
                                            <th> Name </th>
                                            <th> Branch Name </th>
                                            <th> Payment Amount </th>
                                            <th> Payment Date </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($recentPayments as $recentPayment)
                                            <tr>
                                                <td>
                                                    {{ ucwords($recentPayment->client->first_name.' '.$recentPayment->client->last_name) }} </td>
                                                <td>
                                                    {{ $recentPayment->businessBranches->title }}
                                                </td>
                                                <td>
                                                    {{ $recentPayment->payment_amount }} </td>
                                                <td>
                                                    {{ $recentPayment->payment_date->toFormattedDateString() }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No recent payment.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>


                    </div>



                </div>
                <!-- END PAGE CONTENT INNER -->
            @endif

    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/counterup/jquery.counterup.js') !!}
    {!! HTML::script('admin/global/plugins/counterup/jquery.waypoints.min.js') !!}
    {!! HTML::script('admin/global/plugins/morris/morris.min.js') !!}
    {!! HTML::script('admin/global/plugins/morris/raphael-min.js') !!}
    {!! HTML::script('admin/pages/scripts/dashboard.js') !!}
    <script>
        var earningExpenseChart, customerRegistrationChart;
        $(function() {
            earningExpenseChart = Morris.Bar({
                element: 'earningExpenseChart',
                data: {!! $earningExpenseChart !!},
                xkey: 'month',
                ykeys: ['income', 'expense'],
                labels: ['Income', 'Expense']
            });

            customerRegistrationChart = Morris.Bar({
                element: 'customerRegistrationChart',
                data: {!! $clientRegisterChart !!},
                xkey: 'month',
                ykeys: ['client'],
                labels: ['Customer']
            });
        });

        $('.earningExpense').on('click', function () {
            var month = $('#monthEarning').val();
            var year = $('#yearEarning').val();
            var branch = $('#branchEarning').val();
            $.easyAjax({
                type: "GET",
                url: "{{ route('gym-admin.superadmin.getEarningChartData') }}",
                data: {
                    month: month,
                    year: year,
                    branch: branch
                },
                success: function (response) {
                    earningExpenseChart.setData(JSON.parse(response.information));
                }
            });
        });

        $('.customerRegister').on('click', function () {
            var month = $('#monthClient').val();
            var year = $('#yearClient').val();
            var branch = $('#branchClient').val();
            $.easyAjax({
                type: "GET",
                url: "{{ route('gym-admin.superadmin.getClientChartData') }}",
                data: {
                    month: month,
                    year: year,
                    branch: branch
                },
                success: function (response) {
                    customerRegistrationChart.setData(JSON.parse(response.information));
                }
            });
        });
    </script>
@stop