<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Invoice</title>
    <style>

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 100%;
            height: auto;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-size: 14px;
            font-family: 'DejaVu Sans', sans-serif;
        }

        h2 {
            font-weight:normal;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 11px;
        }

        #logo img {
            height: 55px;
            margin-bottom: 15px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 5px 10px 7px 10px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #57B223;
            width: 10%;
        }

        table .desc {
            text-align: left;
        }

        table .unit {
            background: #DDDDDD;
        }


        table .total {
            background: #57B223;
            color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total
        {
            font-size: 1.2em;
            text-align: center;
        }

        table td.unit{
            width: 35%;
        }

        table td.desc{
            width: 45%;
        }

        table td.qty{
            width: 5%;
        }

        .status {
            margin-top: 15px;
            padding: 1px 8px 5px;
            font-size: 1.3em;
            width: 80px;
            color: #fff;
            float: right;
            text-align: center;
            display: inline-block;
        }

        .status.unpaid {
            background-color: #E7505A;
        }
        .status.paid {
            background-color: #26C281;
        }
        .status.cancelled {
            background-color: #95A5A6;
        }
        .status.error {
            background-color: #F4D03F;
        }

        table tr.tax .desc {
            text-align: right;
            color: #1BA39C;
        }
        table tr.discount .desc {
            text-align: right;
            color: #E43A45;
        }
        table tr.tax .desc {
            text-align: right;
            color: #1d0707;
        }
        table tr.subtotal .desc {
            text-align: right;
            color: #1d0707;
        }
        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 10px 20px 10px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-bottom: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }

        table.billing td {
            background-color: #fff;
        }

        table td div#invoiced_to {
            text-align: left;
        }


    </style>
</head>
<body>
<header class="clearfix">


    <table cellpadding="0" cellspacing="0" class="billing">
        <tr>
            <td id="logo" style="text-align: left">
                @if(is_null($settings))
                    <img src="{{ $gymSettingPath.'fitsigma-logo-full.png' }}" class="logo-default img-responsive image-change">
                    @else
                    @if($settings->image != '')
                        @if($settings->local_storage == 0)
                            <img src="{{ $gymSettingPath.$settings->image }}" class="logo-default img-responsive image-change">
                        @else
                            <img src="{{ asset('/uploads/gym_setting/master/').'/'.$settings->image }}" class="logo-default img-responsive image-change">
                        @endif
                    @else
                        <img src="{{ asset('/fitsigma/images/').'/'.'fitsigma-logo-full-red.png' }}" class="logo-default img-responsive image-change">
                    @endif
                @endif
            </td>
        </tr>

        <tr>
            <td>
                <div id="invoiced_to">
                    <small>Billed To:</small>
                    <h2 class="name">{{ ucwords($invoice->client_name) }}</h2>
                    <div>{!! nl2br($invoice->client_address) !!}</div>
                </div>
            </td>
            <td id="company">
                    <small>Generated By:</small>
                    <h2 class="name">{{ ucwords($merchantBusiness->business->title) }}</h2>
                    <div>@if(!is_null($merchantBusiness->business->address)){!! nl2br($merchantBusiness->business->address) !!}@endif</div>
                    <div>@if(!is_null($merchantBusiness->business->phone)){{ $merchantBusiness->business->phone }}@endif</div>
                    @if(!is_null($settings))
                        GST#: <div>{{ $settings->gstin }}</div>
                    @endif

            </td>
        </tr>
    </table>
</header>
<main>
    <div id="details" class="clearfix">

        <div id="invoice">
            <h1>Invoice #{{ $invoice->invoice_number }}</h1>
            <div class="date">Date: {{ $invoice->invoice_date->format("dS M Y") }}</div>
        </div>

    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">#</th>
            <th class="desc">Item</th>
            <th class="qty">Quantity</th>
            <th class="qty">Cost Per Item</th>
            <th class="unit">Price</th>
        </tr>
        </thead>
        <tbody>
        <?php $count = 0; ?>
        @foreach($invoice->items as $item)
            <tr style="page-break-inside: avoid;">
                <td class="no">{{ ++$count }}</td>
                <td class="desc"><h3>{{ ucfirst($item->item_name) }}</h3></td>
                <td class="qty"><h3>{{ $item->quantity }}</h3></td>
                <td class="qty"><h3>{{ $gymSettings->currency->acronym }} {{ $item->cost_per_item }}</h3></td>
                <td class="unit">{{ $gymSettings->currency->acronym }} {{ $item->amount }}</td>
            </tr>
        @endforeach
        <tr style="page-break-inside: avoid;" class="subtotal">
            <td class="no">&nbsp;</td>
            <td class="qty">&nbsp;</td>
            <td class="qty">&nbsp;</td>
            <td class="desc">Subtotal</td>
            <td class="unit">{{ $gymSettings->currency->acronym }} {{ round($invoice->sub_total, 2) }}</td>
        </tr>
        @foreach($invoice->items as $item)
            @if($item->item_type != 'item')
                <tr style="page-break-inside: avoid;" class="@if($item->item_type == 'discount') discount @else tax @endif">
                    <td class="no">&nbsp;</td>
                    <td class="qty">&nbsp;</td>
                    <td class="qty">&nbsp;</td>
                    <td class="desc">@if($item->item_type == 'discount')Discount:@else {{ strtoupper($item->item_name) }}: @endif</td>
                    <td class="unit">@if($item->item_type == 'discount')-@endif{{ $gymSettings->currency->acronym }} {{ round($item->amount, 2) }}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
        <tfoot>
        <tr dontbreak="true">
            <td colspan="4">TOTAL</td>
            <td>{{ $gymSettings->currency->acronym }} {{ round($invoice->total, 2) }}</td>
        </tr>
        </tfoot>
    </table>
    <p>&nbsp;</p>

</main>
</body>
</html>