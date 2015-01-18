<!DOCTYPE html>
<html>
<head>
	<title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,300,600|Montserrat:400,700" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../assets/lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/v2/css/frontend.css') }}" />

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


	<link rel="stylesheet" href="{{ asset('assets/v2/nick_tmp/_setup-wizard-base.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/v2/nick_tmp/_setup-1.mq.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/v2/nick_tmp/_background-common.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/v2/lib/fullPage/jquery.fullPage.css') }}" />
<script src="{{ asset('assets/v2/lib/fullPage/jquery.fullPage.js')}} "></script>


</head>
<body>

	<div class='bg-overlay'></div>


	<div class='row progress-container'>

	</div>

	<div class='container one-page'>

		<header>
			<div class='row header'>

				<div class='col-sm-12 progress-container'>
					<div class='loaded'></div>
					<div class='unloaded'></div>
				</div>

				<div class='col-sm-12 title'>
					<h4>Step 1 of 2 - Choose Device</h4>
				</div>
			</div>
		</header>


		<section>

		<div class='row main-section'>

			<div class='col-sm-6 left step1'>
				<div class='row'>
					<div class='col-sm-12 detected-device-text'>
						<h1 class>Your current device is {{ $device_data->name }}</h1>
					</div>
				</div>

				<div class='row'>
					<div class='col-sm-12 options'>
						<a href="{{ route('setup_step2', ['device_code' => $device_data->device_code ]);}}"><h3>Setup Now</h3></a>
						<a href='devices-page.html'><h3>I want to setup on another device</h3>
					</div>
				</div>
			</div>
			<div class='col-sm-6 right hidden-xs'>
			<img class='device-logo' src='images/win8-sm.png' height='20' width='20'></img>

			</div>
		</div>

		</section>


		<div class='row' id='footer-sticky'>
			<div class='col-xs-4 go-back'>
				<a href='javascript:history.back()'><h4>Go Back</h4></a>
			</div>
			<div class='col-xs-4 questions'>
				<a href='#'><h4>Questions?</h4></a>
			</div>

			<div class='col-xs-4 copyright'>

			</div>
		</div>
	</div>

<script src="_reSizer.js"></script>

<script type="text/javascript">

	// Resize Image using Javascript
	var windowEl = $(window);
	var deviceLogo = $('.device-logo');
	reSizer.elResize(deviceLogo, windowEl, 0.8);

	$(window).resize(function() {
		reSizer.elResize(deviceLogo, windowEl, 0.8);
	});
	// End of Resizing image
</script>
</body>
</html>