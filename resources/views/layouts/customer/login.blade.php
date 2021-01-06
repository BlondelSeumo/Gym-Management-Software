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

    <title>@yield('title')</title>
    <!-- Bootstrap Core CSS -->
    {!! HTML::style('fitsigma_customer/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! HTML::style('fitsigma_customer/bower_components/bootstrap-extension/css/bootstrap-extension.css') !!}
    <!-- animation CSS -->
    {!! HTML::style('customer/css/animate.css') !!}
    {!! HTML::style("admin/global/plugins/font-awesome/css/font-awesome.min.css") !!}
    {!! HTML::style("admin/global/css/font-awesome-animation.min.css") !!}
    <!-- Custom CSS -->
    {!! HTML::style('fitsigma_customer/css/style.css') !!}
    <!-- color CSS -->
    {!! HTML::style('fitsigma_customer/css/colors/default.css') !!}
    {!! HTML::style('admin/global/plugins/froiden-helper/helper.css') !!}
    <style>
        .login-register {
            background:url({{ asset('fitsigma_customer/images/login-register.jpg') }}) center center/cover no-repeat!important;
            height:100%;
            position:fixed
        }
        .error-box {
            height:100%;
            position:fixed;
            background:url({{ asset('fitsigma_customer/images/error-bg.jpg') }}) center center no-repeat #fff!important;
            width:100%
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
@yield('content')
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
<!-- Custom Theme JavaScript -->
{!! HTML::script('fitsigma_customer/js/custom.min.js') !!}
<!--Style Switcher -->
{!! HTML::script('fitsigma_customer/bower_components/styleswitcher/jQuery.style.switcher.js') !!}
{!! HTML::script("admin/global/plugins/froiden-helper/helper.js") !!}
@yield('JS')
</body>

</html>
