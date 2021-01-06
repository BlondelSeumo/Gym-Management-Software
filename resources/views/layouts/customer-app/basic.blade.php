<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    {{-- Favicons--}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon//manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    {{-- Favicons end--}}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Bootstrap Core CSS -->
    {!! HTML::style('fitsigma_customer/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! HTML::style('fitsigma_customer/bower_components/bootstrap-extension/css/bootstrap-extension.css') !!}
    <!-- Menu CSS -->
    {!! HTML::style('fitsigma_customer/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}
    <!-- toast CSS -->
    {{--{!! HTML::style('fitsigma_customer/bower_components/toast-master/css/jquery.toast.css') !!}--}}
    <!-- animation CSS -->
    {!! HTML::style('fitsigma_customer/css/animate.css') !!}
    <!-- Custom CSS -->
    {!! HTML::style('fitsigma_customer/css/style.css') !!}
    <!-- color CSS -->
    {!! HTML::style('fitsigma_customer/css/colors/default.css') !!}
    <!--helper CSS-->
    {!! HTML::style('admin/global/plugins/froiden-helper/helper.css') !!}
    {!! HTML::style('fitsigma_customer/css/custom.css') !!}
    <style>
        .sidebar #side-menu .user-pro {
            background: url({{ asset('fitsigma_customer/images/profile-menu.png') }}) center center/cover no-repeat;
        }
    </style>
    @yield('CSS')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- Preloader -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>
<div id="wrapper">
    <!-- Navigation -->
    @include('layouts.customer-app.navbar')
    <!-- Left navbar-header -->
    @include('layouts.customer-app.sidebar')
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> {{ \Carbon\Carbon::now()->format('Y') }} &copy; Fitsigma Customer App </footer>
    </div>
    <!-- /#page-wrapper -->
</div>

{{--region Show Modal--}}

<div id="customerShowModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Modal</h4>
            </div>
            <div class="modal-body">
                Loading ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{--endregion--}}

{{--region Delete Modal--}}
<div id="customerDeleteModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
            </div>
            <div class="modal-body">
                ....
            </div>
            <div class="modal-footer">
                <button type="button" id="deleteModalBtn" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Delete</button>
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--endregion--}}

<!-- /#wrapper -->
<!-- jQuery -->
{!! HTML::script('fitsigma_customer/bower_components/jquery/dist/jquery.min.js') !!}
<!-- Bootstrap Core JavaScript -->
{!! HTML::script('fitsigma_customer/bootstrap/dist/js/tether.min.js') !!}
{!! HTML::script('fitsigma_customer/bootstrap/dist/js/bootstrap.min.js') !!}
{!! HTML::script('fitsigma_customer/bower_components/bootstrap-extension/js/bootstrap-extension.min.js') !!}
<!-- Menu Plugin JavaScript -->
{!! HTML::script('fitsigma_customer/bower_components/sidebar-nav/dist/sidebar-nav.min.js') !!}
<!--slimscroll JavaScript -->
{!! HTML::script('fitsigma_customer/js/jquery.slimscroll.js') !!}
<!--Wave Effects -->
{!! HTML::script('fitsigma_customer/js/waves.js') !!}
<!--Counter js -->
{!! HTML::script('fitsigma_customer/bower_components/waypoints/lib/jquery.waypoints.js') !!}
{!! HTML::script('fitsigma_customer/bower_components/counterup/jquery.counterup.min.js') !!}

<!-- Custom Theme JavaScript -->
{!! HTML::script('fitsigma_customer/js/custom.min.js') !!}

<!-- Sparkline chart JavaScript -->

{{--{!! HTML::script('fitsigma_customer/bower_components/toast-master/js/jquery.toast.js') !!}--}}

<!--Helper Script-->
{!! HTML::script("admin/global/plugins/froiden-helper/helper.js") !!}
@yield('JS')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".counter").counterUp({
        delay: 100,
        time: 1200
    });

    $('.mark-read').click(function () {
        var url = '{{ route("customer-app.dashboard.markRead") }}';

        $.easyAjax({
            url: url,
            type: 'POST',
            success: function (response) {
                $('.notify').hide();
            }
        })

    });
</script>
</body>
</html>
