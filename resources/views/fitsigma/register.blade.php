<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="Sign up now and get started for free!" />
    <meta name="keywords" content="Fitsigma registration, Fitsigma sign up, Fitisgma create account"/>
    <meta property="og:title" content="Fitsigma - Sign Up" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('fitsigma.signup') }}" />

    <meta property="og:image" content="{{ asset('fitsigma/images/og-image.jpg')}}" />

    <meta property="og:site_name" content="Fitsigma" />
    <meta property="og:description" content="Sign up now and get started for free!"/>
    <link rel="canonical" href="{{ route('fitsigma.signup') }}" />
    <meta property="fb:app_id" content="647860132011926"/>

    <title> Fitsigma - Create Account</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <!-- Bootstrap -->
    {!! HTML::style('fitsigma/css/bootstrap.css')!!}
            <!-- Font Awesome -->
    {!! HTML::style('fitsigma/css/font-awesome.min.css')!!}
            <!-- Stroke Gap Icons -->
    {!! HTML::style('fitsigma/assets/stroke-gap-icons/style.css')!!}
            <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>

    {!! HTML::style('fitsigma/css/style.css')!!}
            <!-- Color CSS -->
    <link id="main" href="{{ asset('fitsigma/css/color_01.css') }}" rel="stylesheet">
    <link id="theme" rel="stylesheet" href="{{ asset('fitsigma/css/color_01.css') }}">
    {!! HTML::style('admin/global/plugins/froiden-helper/helper.css') !!}
    {!! HTML::style("admin/global/plugins/icheck/skins/all.css") !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- Favicons--}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('fitsigma/images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('fitsigma/images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('fitsigma/images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('fitsigma/images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('fitsigma/images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('fitsigma/images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('fitsigma/images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('fitsigma/images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('fitsigma/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('fitsigma/images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('fitsigma/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('fitsigma/images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fitsigma/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('fitsigma/images/favicon//manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('fitsigma/images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    {{-- Favicons end--}}

    @if(App::environment('production'))
            <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                document,'script','https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '506662269518459');
        fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=506662269518459&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
    @endif

    <style>
        .radio-inline + .radio-inline, .checkbox-inline + .checkbox-inline{
            margin-left: 0;
        }
    </style>

    {{--Google analytics--}}
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-83916843-1', 'auto');
        ga('send', 'pageview');

    </script>
    {{--Google analytics end--}}
</head>
<body>
<!-- ==============================================
     **PRE LOADER**
 =============================================== -->
<div id="page-loader" class="primary-bg">
    <span class="loader"><span class="loader-inner"></span></span>
</div>

<!-- ==============================================
             **SIGNUP**
         =============================================== -->
<section id="main-banner">
    <div class="bg-animation">
        <div class="ptb-30"></div>
        <div class="container">
            <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <img src="{{ asset('fitsigma/images/fitsigma-logo-full-white.svg') }}" alt='logo' class="pull-right img-responsive" style="height: 50px">
                        <h4 class="modal-title" id="myModalLabel">Signup</h4> or go back to our <a href="{{ route('fitsigma.index') }}">main site</a>.
                    </div>
                    <div class="modal-body">

                        <form id="signupForm" method="POST" action="#">
                            <div id="merchant-info">
                                <div class="row">
                                    <div class="p-20">
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="first_name" class="control-label">First Name</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" value="" required="" title="Please enter your First Name" placeholder="First Name" tabindex="1">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" value="" required="" title="Please enter your Email" placeholder="Email" tabindex="3">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username" class="control-label">Login Username</label>
                                                    <input type="text" class="form-control" name="username" id="username" value="" required="" title="Please enter your username" placeholder="Username" tabindex="5">
                                                    <span class="help-block"></span>
                                                </div>

                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="last_name" class="control-label">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" value="" required="" title="Please enter your Last Name" placeholder="Last Name" tabindex="2">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mobile" class="control-label">Mobile</label>
                                                    <input type="tel" class="form-control" name="mobile" id="mobile" value="" required="" title="Please enter your Mobile number" placeholder="10 digit mobile number" tabindex="4">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="control-label">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required="" title="Please enter your Password" tabindex="6">
                                                    <span class="help-block"></span>
                                                </div>

                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="p-20">
                                            <div class="checkbox">
                                                <p class="help-block">I have Already an Account <a href="{{ route('merchant.login.index') }}?utm_source=fitsigma&utm_medium=register&utm_campaign=signin"> Login</a></p>
                                            </div>
                                            <button type="button" id="signup-next-btn" class="btn btn-theme-primary btn-block">Next <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="business-info" style="display: none">
                                <div class="row">
                                    <div class="p-20">
                                            <div class="col-md-12">
                                                <a href="javascript:;" id="register-back-btn"><i class="fa fa-arrow-left"></i> Back</a>
                                            </div>
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="business_name" class="control-label">Business Name</label>
                                                    <input type="text" class="form-control" name="title" id="business_name" value="" required="" title="Please enter your Business Name" placeholder="Business Name">
                                                    <span class="help-block"></span>
                                                </div>

                                            </div>

                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="business_name" class="control-label col-xs-12">Services Offered</label>
                                                            @foreach($gymCategories as $cat)
                                                                <div class="col-md-5 col-xs-12">
                                                                    <input type="checkbox" id="category-{{ $cat->id }}" value="{{ $cat->id }}" name="category[]">
                                                                    <label for="category-{{ $cat->id }}">{{ $cat->name }}</label>
                                                                </div>
                                                            @endforeach

                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="address" class="control-label">Complete Address</label>
                                                    <textarea name="address" id="address" class="form-control" cols="30" rows="3"></textarea>
                                                    <span class="help-block"></span>
                                                </div>

                                            </div>

                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <div class="g-recaptcha" name="recaptcha" data-sitekey="{{ env('RECAPTCHA_KEY') }}"></div>
                                                    <span class="help-block"></span>
                                                </div>

                                            </div>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="p-20">
                                            <div class="checkbox">
                                                <p class="help-block">I have Already an Account <a href="{{ route('merchant.login.index') }}?utm_source=fitsigma&utm_medium=register&utm_campaign=signin"> Login</a></p>
                                            </div>
                                            <button type="button" name="submit" id="signup-submit-btn" class="btn btn-theme-primary btn-block">register now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="ptb-20">
                        <p class="text-center">Copyright &COPY; <a href="http://www.froiden.com">Froiden</a>. {{ \Carbon\Carbon::today('Asia/Calcutta')->year }}. </p>
                    </div>
                </div>

            </div>
        </div><!-- End Container -->
    </div><!-- End Background Animation -->
</section><!-- End Section -->

<!-- jQuery  -->
{!! HTML::script('fitsigma/js/jquery.min.js')!!}
        <!-- Include all compiled plugins (below), or include individual files as needed -->
{!! HTML::script('fitsigma/js/bootstrap.min.js')!!}

@yield('footer')
        <!-- Custom JS -->
{!! HTML::script('fitsigma/js/custom.js')!!}
{!! HTML::script("admin/global/plugins/froiden-helper/helper.js") !!}
{!! HTML::script('https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCsaV9v-birEOQ1clvo07bUWDIO_rcpk-A')  !!}
{!! HTML::script('admin/global/plugins/gmaps/gmaps.min.js')  !!}
{!! HTML::script('admin/global/plugins/icheck/icheck.min.js')  !!}
{!! HTML::script("https://www.google.com/recaptcha/api.js") !!}


<script>
    var signUpNextBtn = $('#signup-next-btn');
    var signUpSubmitBtn = $('#signup-submit-btn');
    var businessInfoDiv = $('#business-info');
    var merchantInfoDiv = $('#merchant-info');
    var registerBackBtn = $('#register-back-btn');

    signUpNextBtn.click(function () {
        var url = '{{ route('fitsigma.signup.profileValidate') }}';
        $.easyAjax({
            url : url,
            type:'POST',
            data: $('#signupForm').serialize(),
            container: '#signupForm',
            success:function(response)
            {
                if(response.status == 'success'){
                    merchantInfoDiv.slideUp();
                    businessInfoDiv.show();
                }

                $('#main-banner .bg-animation').css('height',$( document ).height()+'px');
            }
        })
    });

    signUpSubmitBtn.click(function () {
        signUpSubmitBtn.prop('disabled', true);
        var url = '{{ route('fitsigma.signup.profileSave') }}';
        $.easyAjax({
            url : url,
            type:'POST',
            data: $('#signupForm').serialize(),
            success:function(response)
            {
                if(response.status == 'success'){
                    merchantInfoDiv.slideUp();
                    businessInfoDiv.show();
                }
                $('#main-banner .bg-animation').css('height',$( document ).height()+'px');

            }
        })
    });

    registerBackBtn.click(function () {
        merchantInfoDiv.fadeIn();
        businessInfoDiv.hide();
    });

    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal'
    });


</script>

</body>

</html>