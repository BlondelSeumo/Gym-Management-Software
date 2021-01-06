<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Fitsigma | Merchant Lock Screen</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    {!! HTML::style('admin/global/plugins/font-awesome/css/font-awesome.min.css') !!}
    {!! HTML::style('admin/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap/css/bootstrap.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    {!! HTML::style('admin/global/css/components-md.min.css') !!}
    {!! HTML::style('admin/global/css/plugins-md.min.css') !!}
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style('admin/pages/css/lock-2.min.css') !!}
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('ace/images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('ace/images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('ace/images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('ace/images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('ace/images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('ace/images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('ace/images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('ace/images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('ace/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('ace/images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('ace/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('ace/images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('ace/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('ace/images/favicon//manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('ace/images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <style>
        .size-icon {
            font-size: 18px;
        }
    </style>
</head>
<!-- END HEAD -->

<body>
@yield('content')
<!--[if lt IE 9]>
{!! HTML::script('admin/global/plugins/respond.min.js') !!}
{!! HTML::script('admin/global/plugins/excanvas.min.js') !!}
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
{!! HTML::script('admin/global/plugins/jquery.min.js') !!}
{!! HTML::script('admin/global/plugins/bootstrap/js/bootstrap.min.js') !!}
{!! HTML::script('admin/global/plugins/js.cookie.min.js') !!}
{!! HTML::script('admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
{!! HTML::script('admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{!! HTML::script('admin/global/plugins/jquery.blockui.min.js') !!}
{!! HTML::script('admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! HTML::script('admin/global/plugins/backstretch/jquery.backstretch.min.js') !!}
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
{!! HTML::script('admin/global/scripts/app.min.js') !!}
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    $('#login-form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url : '{{ route('merchant.lockLogin') }}',
            type: 'POST',
            data: $('#login-form').serialize(),
            container: '#login-form',
            success: function (response) {
                console.log(response);
                if(response.success == false) {
                    $('#error-message').addClass("alert alert-danger");
                    $('#error-message').html(response.message);
                } else {
                    $('#error-message').removeClass("alert alert-danger");
                    $('#error-message').addClass("alert alert-success");
                    $('#error-message').html(response.message);
                    window.location.href = response.url;
                }
            }
        });
        return false;
    });

    var image_1 = '{{ asset("admin/pages/media/bg/1.jpg") }}';
    var image_2 = '{{ asset("admin/pages/media/bg/2.jpg") }}';
    var image_3 = '{{ asset("admin/pages/media/bg/3.jpg") }}';
    var image_4 = '{{ asset("admin/pages/media/bg/4.jpg") }}';

    $.backstretch([
        image_1,
        image_2,
        image_3,
        image_4
    ], {
        fade: 1000,
        duration: 8000
    });
</script>
</body>

</html>