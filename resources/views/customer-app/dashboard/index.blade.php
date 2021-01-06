@extends('layouts.customer-app.basic')

@section('title')
    Fitsigma | Customer Dashboard
@endsection

@section('CSS')
    {!! HTML::style('fitsigma_customer/bower_components/morrisjs/morris.css') !!}
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Main Menu</li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Subscription</h3>
                <ul class="list-inline two-part">
                    <li class="text-right"><i class="text-success"></i> <span class="counter text-purple">{{ $totalSubscriptions }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Amount Paid</h3>
                <ul class="list-inline two-part">
                    <li class="text-right"><i class="fa {{ $gymSettings->currency->symbol }} text-success"></i> <span class="counter text-success">{{ $totalAmountPaid }}</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="box-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">Due Payments</span>
                        <span class="caption-helper"></span>
                    </div>
                </div>
                <div class="box-body flip-scroll">

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
            <div class="white-box">
                <div class="box-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">Subscriptions Expiring in next 45 days</span>
                        <span class="caption-helper"></span>
                    </div>
                </div>
                <div class="box-body flip-scroll">

                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                        <tr class="uppercase">
                            <th> # </th>
                            <th> Client Name </th>
                            <th> Expiring on </th>
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
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td></td>
                                <td>No subscription expiring.</td>
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
        <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">Payments Chart</h3>
                <div id="morris-bar-chart"></div>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    {!! HTML::script('fitsigma_customer/bower_components/raphael/raphael-min.js') !!}
    {!! HTML::script('fitsigma_customer/bower_components/morrisjs/morris.js') !!}

    <script>
        var months = [];
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
        Morris.Bar({
            element: 'morris-bar-chart',
            data: [
                @foreach($paymentCharts as $chart)
                {
                    "Month": months['{{$chart->M}}'],
                    "Income": '{{$chart->S}}'
                },
                @endforeach
            ],
            xkey: 'Month',
            ykeys: ['Income'],
            labels: ['Income'],
            barColors:['#b8edf0', '#b4c1d7'],
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            resize: true
        });
    </script>
@endsection