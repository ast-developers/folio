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
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		{!! HTML::style("css/your_style.css") !!} -->



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

	</head>
	

	<body class="">


    <!-- MAIN CONTENT -->
    <div id="content">

        @yield('content')

    </div>
    <!-- END MAIN CONTENT -->

    <!--================================================== -->


		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


		<!-- IMPORTANT: APP CONFIG -->
		{!! HTML::script("js/app.config.js") !!}

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		{!! HTML::script("js/plugin/jquery-touch/jquery.ui.touch-punch.min.js") !!}

		<!-- BOOTSTRAP JS -->
		{!! HTML::script("js/bootstrap/bootstrap.min.js") !!}

		<!-- JQUERY VALIDATE -->
		{!! HTML::script("js/plugin/jquery-validate/jquery.validate.min.js") !!}

		<!-- JQUERY MASKED INPUT -->
		{!! HTML::script("js/plugin/masked-input/jquery.maskedinput.min.js") !!}

		<!-- browser msie issue fix -->
		{!! HTML::script("js/plugin/msie-fix/jquery.mb.browser.min.js") !!}

		<!-- MAIN APP JS FILE -->
		{!! HTML::script("js/app.min.js") !!}

		<script>
			$(document).ready(function() {

				$('.ui-tabs').tabs();

			});

		</script>


	</body>

</html>