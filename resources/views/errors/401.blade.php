<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.1.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Fitsigma | Permission Error</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {!! HTML::style("//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all") !!}
    {!! HTML::style("admin/global/plugins/font-awesome/css/font-awesome.min.css") !!}
    {!! HTML::style("admin/global/plugins/simple-line-icons/simple-line-icons.min.css") !!}
    {!! HTML::style("admin/global/plugins/bootstrap/css/bootstrap.min.css") !!}
    {!! HTML::style("admin/global/plugins/uniform/css/uniform.default.css") !!}
    {!! HTML::style("admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") !!}
            <!-- END GLOBAL MANDATORY STYLES -->

    {!! HTML::style("admin/admin/pages/css/error.css") !!}

            <!-- BEGIN THEME STYLES -->
    {!! HTML::style("admin/global/css/components-rounded.css") !!}
    {!! HTML::style("admin/global/css/plugins.css") !!}
    {!! HTML::style("admin/admin/layout4/css/layout.css") !!}
    {!! HTML::style("admin/admin/layout4/css/themes/default.css") !!}
    {!! HTML::style("admin/admin/layout4/css/custom.css") !!}
            <!-- END THEME STYLES -->

    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/apple-icon-180x180.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/android-icon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/favicon-32x32.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/favicon-96x96.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('front/icons/favicon-16x16.png')}}">
    <link rel="icon" type="image/png" href="{{URL::asset('front/icons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{URL::asset('front/icons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{URL::asset('front/icons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-404-full-page">
<div class="row">
    <div class="col-md-12 page-404">
        <div class="number">
            401
        </div>
        <div class="details">
            <h3>Oops! You Don't Have Permission For This Action.</h3>
            <p>
                We can not find the page you're looking for.<br/>
                <a class="btn blue" href="{{ URL::previous() }}">
                    <i class="fa fa-arrow-left"></i> Return Back </a>
            </p>

        </div>
    </div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
{!! HTML::script("admin/global/plugins/respond.min.js") !!}
{!! HTML::script("admin/global/plugins/excanvas.min.js") !!}
<![endif]-->
{!! HTML::script("admin/global/plugins/jquery.min.js") !!}
{!! HTML::script("admin/global/plugins/jquery-migrate.min.js") !!}
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
{!! HTML::script("admin/global/plugins/jquery-ui/jquery-ui.min.js") !!}
{!! HTML::script("admin/global/plugins/bootstrap/js/bootstrap.min.js") !!}
{!! HTML::script("admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js") !!}
{!! HTML::script("admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js") !!}
{!! HTML::script("admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js") !!}
{!! HTML::script("admin/global/plugins/jquery.blockui.min.js") !!}
{!! HTML::script("admin/global/plugins/jquery.cokie.min.js") !!}
{!! HTML::script("admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
<!-- END CORE PLUGINS -->
{!! HTML::script("admin/global/scripts/metronic.js") !!}
{!! HTML::script("admin/admin/layout4/scripts/layout.js") !!}
{!! HTML::script("admin/admin/layout4/scripts/demo.js") !!}
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>