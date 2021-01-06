<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    {!! HTML::style("admin/global/plugins/simple-line-icons/simple-line-icons.min.css") !!}
    {!! HTML::style("admin/global/plugins/bootstrap/css/bootstrap.min.css") !!}

    <style>
        .ace-logo {
            max-height: 50px;
            margin: 15px auto;
        }

        .header {
            background: #242424;
        }

        .margin-top-75 {
            margin-top: 75px;
        }
    </style>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 header">
            <img src="{{ asset('ace/images/ace-logo-white.svg') }}" class="img-responsive ace-logo" alt="ace logo">
        </div>
    </div>

    <div class="row">

        @if($checkIn == 'success')

            <div class="col-md-12 text-center margin-top-75">
                <h2>
                    <i style="font-size: 3em; color: #1c8f5f" class="icon-check"></i>
                </h2>

                <p>&nbsp;</p>
                <h4>
                    {{ ucwords($client->first_name.' '.$client->last_name) }}
                </h4>

                <p style="font-size: 1.2em">
                    Checked In Today at {{ $attendance->check_in->format('h:i A') }}
                </p>
            </div>

        @else
            <div class="col-md-12 text-center margin-top-75">
                <h2>
                    <i style="font-size: 3em; color: #c51c1e" class="icon-close"></i>
                </h2>

                <p>&nbsp;</p>
                <h4>
                    {{ ucwords($client->first_name.' '.$client->last_name) }}
                </h4>

                <p style="font-size: 1.2em">
                    Already Checked In at {{ $attendance->check_in->format('h:i A') }}
                </p>
            </div>
        @endif
    </div>

</div>

{!! HTML::script("admin/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js") !!}
{!! HTML::script("admin/global/plugins/bootstrap/js/bootstrap.min.js") !!}

</body>
</html>