@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    <style>
        .CSSAnimationChart, .mapChart{
            height: 339px;
        }
    </style>
@stop


@section('content')
    <div class="container-fluid">

        @if($completedItems  < $completedItemsRequired)
        {{-- Account setup progress start --}}


        @if($completedItems == 1)
            <div class="row">

                <div class="col-xs-12">
                    <img src="{{ asset('admin/pages/img/welcome-to-fitsigma.jpg') }}" class="img-responsive" alt="">
                </div>
                <div class="col-xs-12 text-center hidden-xs hidden-sm" style="margin-top: -100px">
                    <a href="{{ route('gym-admin.account-setup.profile') }}" class="btn btn-lg white font-green">Let's do a quick account setup <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center visible-xs visible-sm margin-top-5" >
                    <a href="{{ route('gym-admin.account-setup.profile') }}" class="btn green">Let's do a quick account setup <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        @else

                <div class="row">

                    <div class="col-xs-12">
                        <img src="{{ asset('admin/pages/img/welcome-to-fitsigma.jpg') }}" class="img-responsive" alt="">
                    </div>
                    <div class="col-xs-12 text-center hidden-xs hidden-sm" style="margin-top: -100px">
                        <a href="{{ route('gym-admin.account-setup.profile') }}" class="btn btn-lg white font-green">Start Over <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
        @endif

        @if($completedItems > 1)
            <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-speedometer font-red"></i>
								<span class="caption-subject bold font-red uppercase">
								Account Setup Progress </span>
                            <span class="caption-helper">{{ round($completedItems*(100/$completedItemsRequired),1) }}% COMPLETE</span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        @if($completedItems > 1)
                            <div class="col-md-12">
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                         aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                         style="width: {{ ($completedItems*(100/$completedItemsRequired)) }}%">
                                        <span class="sr-only">
                                        {{ ($completedItems*(100/$completedItemsRequired)) }}% Complete </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(trim($user->first_name) == "" || trim($user->last_name) == "" || trim($user->mobile) == "")
                            <div class="col-md-12">
                                <strong>Next Step:</strong>
                                <a class="btn blue-chambray" href="{{ route('gym-admin.account-setup.profile') }}">
                                    Update your first & last name


                                    <i class="fa fa-arrow-right"></i>
                                </a>

                            </div>

                        @elseif(count($memberships) == 0)
                            <div class="col-md-12">
                                <strong>Next Step:</strong>
                                <a class="btn blue-chambray"  href="{{ route('gym-admin.account-setup.membership') }}">
                                    Add Membership

                                    <i class="fa fa-arrow-right"></i>
                                </a>

                            </div>

                        @elseif(count($clients) == 0)
                            <div class="col-md-12">
                                <strong>Next Step:</strong>
                                <a class="btn blue-chambray"  href="{{ route('gym-admin.account-setup.client') }}">
                                    Add First Customer

                                    <i class="fa fa-arrow-right"></i>
                                </a>

                            </div>



                        @elseif(count($subscriptions) == 0)
                            <div class="col-md-12">
                                <strong>Next Step:</strong>
                                <a class="btn blue-chambray"  href="{{ route('gym-admin.account-setup.subscription') }}">
                                    Add Subscription

                                    <i class="fa fa-arrow-right"></i>
                                </a>

                            </div>

                        @elseif(count($payments) == 0)
                            <div class="btn blue-chambray"  class="col-md-12">
                                <strong>Next Step:</strong>
                                <a href="{{ route('gym-admin.account-setup.payment') }}">
                                    Add Payment

                                    <i class="fa fa-arrow-right"></i>
                                </a>

                            </div>

                        @endif

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </div>

            <div class="row">
                <div class="col-xs-12 text-center visible-xs visible-sm margin-top-5" >
                    <a href="{{ route('gym-admin.account-setup.profile') }}" class="btn btn-block green">Start Over <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        @endif
        {{-- Account setup progress end --}}
        @else


        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Dashboard</span>
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
                        <h4 class="widget-thumb-heading">Total Earning</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-green fa {{ $gymSettings->currency->symbol }}"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">{{ $gymSettings->currency->acronym }}</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$currentBalance}}">0</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">Weekly Earning</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-red fa {{ $gymSettings->currency->symbol }}"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">{{ $gymSettings->currency->acronym }}</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$weeklySales}}">0</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">Biggest Purchase</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-purple fa {{ $gymSettings->currency->symbol }}"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">{{ $gymSettings->currency->acronym }}</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$maxSale}}">0</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">Average Monthly</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue fa {{ $gymSettings->currency->symbol }}"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">{{ $gymSettings->currency->acronym }}</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$averageMonthly}}">0</span>
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
                            <div class="number" data-counter="counterup" data-value="{{$totalCustomers}}"> 0 </div>
                            <div class="desc"> Total Customers </div>
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
                            <div class="number" data-counter="counterup" data-value="{{$monthlyCustomers}}"> 0</div>
                            <div class="desc"> Customers This Month </div>
                        </div>

                    </div>
                    <!-- END WIDGET THUMB -->
                </div>

                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="dashboard-stat grey-mint">
                        <div class="visual">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="details">
                            <div class="number" data-counter="counterup" data-value="{{$monthlyVisitors}}"> 0 </div>
                            <div class="desc"> Visitors This Month </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>

                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="dashboard-stat green-soft">
                        <div class="visual">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="details">
                            <div class="number" data-counter="counterup" data-value="{{$todayAttendance}}"> 0 </div>
                            <div class="desc"> Today's Check Ins </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>


            </div>
            @if(count($targets) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption ">
                                    <span class="caption-subject font-dark bold uppercase"><i class="icon-target"></i> My Targets</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                @forelse($targets as $target)
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
                @if($common_details->huntplex_listing == 'yes')
                <div class="col-md-6">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption ">
                                <span class="caption-subject font-dark bold uppercase">Monthly Business Views</span>
                                <span class="caption-helper"></span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="chartdiv" class="CSSAnimationChart"></div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="@if($common_details->huntplex_listing == 'yes') col-md-6 @else col-md-12 @endif">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption ">
                                    <span class="caption-subject font-dark bold uppercase">Sales By Memberships</span>
                                    <span class="caption-helper"></span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="salesChart" class="CSSAnimationChart"></div>
                            </div>
                        </div>
                    </div>

            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption ">
                                <span class="caption-subject font-dark bold uppercase">Finance</span>
                                <span class="caption-helper"></span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="financeChart" class="CSSAnimationChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption ">
                                <span class="caption-subject font-dark bold uppercase">Due Payments</span>
                                <span class="caption-helper"></span>
                            </div>
                        </div>
                        <div class="portlet-body flip-scroll">

                            <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead class="flip-content">
                                <tr class="uppercase">
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Due Amount </th>
                                    <th> Due Date </th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($duePayments as $key=>$payment)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td>
                                            {{ ucwords($payment->first_name.' '.$payment->last_name) }} </td>
                                        <td> <i class="fa {{ $gymSettings->currency->symbol }}"></i>{{ $payment->amount_to_be_paid - $payment->paid }} </td>
                                        <td>
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $payment->due_date)->toFormattedDateString() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No due payments.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption ">
                                <span class="caption-subject font-dark bold uppercase">Subscriptions Expiring in next 45 days</span>
                                <span class="caption-helper"></span>
                            </div>
                        </div>
                        <div class="portlet-body flip-scroll">
                                <table class="table table-bordered table-striped table-condensed flip-content">
                                    <thead class="flip-content">
                                    <tr class="uppercase">
                                        <th> # </th>
                                        <th> Client Name </th>
                                        <th> Expiring on </th>
                                        <th> Action </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($expiringSubscriptions as $key=>$expSubs)
                                        <tr>
                                            <td> {{ $key+1 }} </td>
                                            <td>
                                                {{ ucwords($expSubs->first_name.' '.$expSubs->last_name) }} </td>
                                            <td>
                                                {{ $expSubs->expires_on->format('d M, Y') }}
                                            </td>
                                            <td>
                                                <div class="dropup">
                                                    <button class="btn blue btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-gears"></i> <span class="hidden-xs">Actions</span>
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                        <li>
                                                            <a href="javascript:;" data-id="{{ $expSubs->id }}" class="show-subscription-reminder"><i class="fa fa-send"></i> Send Reminder</a>
                                                        </li>
                                                        <li>
                                                            <a class="renew-subscription" data-id="{{ $expSubs->id }}"  href="javascript:;"><i class="icon-refresh"></i>  Renew Subscription</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>No subscription expiring.</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-users font-dark"></i>
                                <span class="caption-subject font-dark bold uppercase">Recent Customers</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="mt-element-card mt-element-overlay">
                                <div class="row">
                                    @foreach($recentClients as $client)
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="mt-card-item mt-element-ribbon no-padding">
                                                <div class="ribbon ribbon-clip ribbon-color-danger uppercase col-xs-8" style="font-size: 10px">
                                                    <div class="ribbon-sub ribbon-clip"></div> {{$client->created_at->diffForHumans(\Carbon\Carbon::now('Asia/Calcutta'))}}
                                                </div>
                                                <div class="mt-card-avatar mt-overlay-1">
                                                    @if($client->image != '')
                                                        @if($gymSettings->local_storage == '0')
                                                            <img src="{{ $profileHeaderPath.$client->image }}" />
                                                        @else
                                                            <img src="{{asset('/uploads/profile_pic/master/').'/'.$client->image}}" />
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('/fitsigma/images/').'/'.'user.svg' }}">
                                                    @endif

                                                    <div class="mt-overlay">
                                                        <ul class="mt-info">

                                                        <li>
                                                            <a class="btn default btn-outline" href="{{route('gym-admin.client.show',$client->id)}}">
                                                                <i class="icon-link"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="mt-card-content">
                                                <h3 class="mt-card-name">{{$client->first_name}}&nbsp;{{$client->last_name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-globe font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Notifications</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" class="active" data-toggle="tab"> Unread </a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab"> Read </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <!--BEGIN TABS-->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tab_1_1">
                                    <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                        <ul class="feeds">
                                            @foreach($notis as $noti)
                                                @if($noti->read_status =='unread')
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> {{$noti->title}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> {{$noti->created_at->diffForHumans(\Carbon\Carbon::now('Asia/Calcutta'))}}</div>
                                                </div>
                                            </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_1_2">
                                    <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
                                        <ul class="feeds">
                                            @foreach($notis as $noti)
                                                @if($noti->read_status =='read')
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> {{$noti->title}} </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> {{$noti->created_at->diffForHumans(\Carbon\Carbon::now('Asia/Calcutta'))}} </div>
                                                </div>
                                            </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END TABS-->
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>


            </div>



        </div>
        <!-- END PAGE CONTENT INNER -->
            @endif

        @endif
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
{!! HTML::script('admin/global/plugins/counterup/jquery.counterup.js') !!}
{!! HTML::script('admin/global/plugins/counterup/jquery.waypoints.min.js') !!}

{!! HTML::script('admin/global/plugins/morris/morris.min.js') !!}

{!! HTML::script('admin/global/plugins/amcharts/amcharts/amcharts.js') !!}
{!! HTML::script('admin/global/plugins/amcharts/amcharts/serial.js') !!}
{!! HTML::script('admin/global/plugins/amcharts/amcharts/pie.js') !!}
{!! HTML::script('admin/global/plugins/amcharts/amcharts/themes/light.js') !!}



{!! HTML::script('admin/pages/scripts/dashboard.js') !!}


<script>


    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "path": "../assets/global/plugins/amcharts/ammap/images/",
        "addClassNames": true,
        "theme": "light",
        "autoMargins": false,
        "marginLeft": 60,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 26,
        "balloon": {
            "adjustBorderColor": false,
            "horizontalPadding": 10,
            "verticalPadding": 8,
            "color": "#ffffff"
        },

        "dataProvider": [
                @foreach($chartData as $chart)
            {
                "year": "{{ $chart->month }}-"+{{ $chart->year }},
                "income": {{ $chart->views }},
                "expenses": {{ $chart->views }}
            },
            @endforeach
        ],
        "valueAxxes": [{
            "axisAlpha": 0,
            "position": "left"
        }],
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "fillAlphas": 1,
            "title": "Views",
            "type": "column",
            "valueField": "income",
            "dashLengthField": "dashLengthColumn"
        }, {
            "id": "graph2",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "bullet": "round",
            "lineThickness": 3,
            "bulletSize": 7,
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "useLineColorForBulletBorder": true,
            "bulletBorderThickness": 3,
            "fillAlphas": 0,
            "lineAlpha": 1,
            "title": "Views Line Chart",
            "valueField": "expenses"
        }],
        "categoryField": "year",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0
        },
        "export": {
            "enabled": true
        }, legend: {
            useGraphSettings: true
        }
    });
    </script>
    <script>

    var months = new Array();
    months['1'] = 'Jan';
    months['2'] = 'Feb';
    months['3'] = 'Mar';
    months['4'] = 'Apr';
    months['5'] = 'May';
    months['6'] = 'Jun';
    months['7'] = 'Jul';
    months['8'] = 'Aug';
    months['9'] = 'Sep';
    months['10'] = 'Oct';
    months['11'] = 'Nov';
    months['12'] = 'Dec';
    var chart = AmCharts.makeChart("financeChart", {
        "type": "serial",
        "addClassNames": true,
        "theme": "light",
        "path": "../assets/global/plugins/amcharts/ammap/images/",
        "autoMargins": false,
        "marginLeft": 45,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 26,
        "balloon": {
            "adjustBorderColor": false,
            "horizontalPadding": 10,
            "verticalPadding": 8,
            "color": "#ffffff"
        },

        "dataProvider": [
                @foreach($financeCharts as $chart)
            {
            "Month": months['{{$chart->M}}'],
            "income": '{{$chart->S}}'
            },
                @endforeach
        ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left"
        }],
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "fillAlphas": 1,
            "title": "Income",
            "type": "column",
            "valueField": "income",
            "dashLengthField": "dashLengthColumn"
        }, {
            "id": "graph2",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "bullet": "round",
            "lineThickness": 3,
            "bulletSize": 7,
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "useLineColorForBulletBorder": true,
            "bulletBorderThickness": 3,
            "fillAlphas": 0,
            "lineAlpha": 1,
            "title": "Expenses",
            "valueField": "expenses"
        }],
        "categoryField": "Month",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0
        },
        "export": {
            "enabled": true
        }
    });

    var pie = AmCharts.makeChart("salesChart", {
        "type": "pie",
        "theme": "light",
        "path": "../assets/global/plugins/amcharts/ammap/images/",
        "dataProvider": [
                @foreach($membershipsStats as $mem)
            {
                "country": "{{$mem['title']}}",
                "value": "{{$mem['total']}}"
            },
                @endforeach
        ],
        "valueField": "value",
        "titleField": "country",
        "outlineAlpha": 0.4,
        //"depth3D": 15,
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        //"angle": 30,
        "export": {
            "enabled": true
        }
    });
    jQuery('.chart-input').off().on('input change', function() {
        var property = jQuery(this).data('property');
        var target = pie;
        var value = Number(this.value);
        pie.startDuration = 0;

        if (property == 'innerRadius') {
            value += "%";
        }

        target[property] = value;
        pie.validateNow();
    });


    //        send subscription reminder
    $('.show-subscription-reminder').click(function () {
        var id = $(this).data('id');
        var show_url = '{{route('gym-admin.client-purchase.show-subscription-reminder-modal',['#id'])}}';
        var url = show_url.replace('#id', id);
        $('#modelHeading').html('Select Time');
        $.ajaxModal("#reminderModal", url);
    });

    //        renew subscription
    $('.renew-subscription').click( function () {
        var id = $(this).data('id');
        var show_url = '{{route('gym-admin.client-purchase.renew-subscription-modal',['#id'])}}';
        var url = show_url.replace('#id', id);
        $('#modelHeading').html('Renew Subscription');
        $.ajaxModal("#reminderModal", url);
    });
</script>
@stop