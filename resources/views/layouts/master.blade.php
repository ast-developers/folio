<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

    <title> Arsenaltech - Portfolio Management </title>
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Basic Styles -->

    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style("css/font-awesome.min.css") !!}

            <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    {!! HTML::style("css/smartadmin-production-plugins.min.css") !!}
    {!! HTML::style("css/smartadmin-production.min.css") !!}
    {!! HTML::style("css/smartadmin-skins.min.css") !!}

            <!-- SmartAdmin RTL Support  -->
    {!! HTML::style("css/smartadmin-rtl.min.css") !!}

            <!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.-->
    {!! HTML::style("css/your_style.css") !!}


            <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- Specifying a Webpage Icon for Web Clip
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="{{ url("img/splash/sptouch-icon-iphone.png") }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url("img/splash/touch-icon-ipad.png") }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url("img/splash/touch-icon-iphone-retina.png") }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url("img/splash/touch-icon-ipad-retina.png") }}">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="{{ url("img/splash/ipad-landscape.png") }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="{{ url("img/splash/ipad-portrait.png") }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="{{ url("img/splash/iphone.png") }}" media="screen and (max-device-width: 320px)">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{!! asset('css/sweetalert.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/your_style.css') !!}">
</head>


<body class="">

<!-- HEADER -->
<header id="header">
    <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <span id="logo"> {!! HTML::image("img/logo.png", "Admin")  !!}  </span>
        <!-- END LOGO PLACEHOLDER -->

    </div>

    <!-- pulled right: nav area -->
    <div class="pull-right">

        <div class="dropdown  pull-right " style="margin-top: 15px; margin-left: 5px">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <b>{{ Auth::user()->name }}</b> <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i> Profile</a></li>
                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>
        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- end collapse menu -->

        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
        </div>
        <!-- end fullscreen button -->

        <!-- Global Date range filter -->

        <div id="fullscreen" class="pull-right" style="margin-top: 10px">

                    <span>From:
                        {!! Form::text('text', (session('from_date')!=NULL) ? session('from_date') : NULL, array('id'=>'datepickerFrom')) !!}
                    </span>
                    <span>To:
                        {!! Form::text('text', (session('to_date')!=NULL) ? session('to_date') : NULL, array('id'=>'datepickerTo')) !!}
                    </span>

        </div>


        <!-- End Global date range filter -->
    </div>
    <!-- end pulled right: nav area -->

</header>


<!-- END HEADER -->

<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<!-- NAVIGATION : This navigation is also responsive-->
    @include('menu.navigation')
<!-- END NAVIGATION -->

<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content">
        @include('Notifications.messages')
        @yield('content')

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->


<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


<!-- IMPORTANT: APP CONFIG -->
{!! HTML::script("js/app.config.js") !!}

        <!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
{!! HTML::script("js/plugin/jquery-touch/jquery.ui.touch-punch.min.js") !!}

        <!-- BOOTSTRAP JS -->
{!! HTML::script("js/bootstrap/bootstrap.min.js") !!}


        <!-- JARVIS WIDGETS -->
{!! HTML::script("js/smartwidgets/jarvis.widget.min.js") !!}


        <!-- JQUERY VALIDATE -->
{!! HTML::script("js/plugin/jquery-validate/jquery.validate.min.js") !!}

        <!-- JQUERY MASKED INPUT -->
{!! HTML::script("js/plugin/masked-input/jquery.maskedinput.min.js") !!}

        <!-- JQUERY SELECT2 INPUT -->
{!! HTML::script("js/plugin/select2/select2.min.js") !!}

        <!-- JQUERY UI + Bootstrap Slider -->
{!! HTML::script("js/plugin/bootstrap-slider/bootstrap-slider.min.js") !!}

        <!-- browser msie issue fix -->
{!! HTML::script("js/plugin/msie-fix/jquery.mb.browser.min.js") !!}

        <!-- FastClick: For mobile devices -->
{!! HTML::script("js/plugin/fastclick/fastclick.min.js") !!}

        <!-- custom js -->
{!! HTML::script("js/custom/filter.js") !!}


@yield('js')

        <!-- sweetalert js -->
{!! HTML::script("js/plugin/sweet-alerts/sweetalert.min.js") !!}
		{!! HTML::script("js/plugin/sweet-alerts/sweetalert-dev.js") !!}


		<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->


<!-- MAIN APP JS FILE -->
{!! HTML::script("js/app.min.js") !!}


<script>
    $(document).ready(function () {
        $('.ui-tabs').tabs();
        $('.ui-tabs').show();

        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });

    });
    var base_url = window.location.origin;
    $(".delete").click(function () {
        return confirm('Do you sure want to delete the record?');
    });
</script>

</body>

</html>