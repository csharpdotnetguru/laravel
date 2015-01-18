@extends('layout.test')

@section('content')

	@include('partials._notification')

	<h2>Setup Wizard</h2>
	<hr>

	<br>
	<h3>We recommend you to setup on PC/Mac as homebase; don’t worry, you can set up other devices later</h3>
	<br>

	@if($device_data['device_type'] == 'pc')
		<!-- For detected Device -->
		@if(!empty($device_data['detected_device']))
			<div id="detected-device-pc-cn">
				<h3 class="well">
					Your current device is {{$device_data['detected_device']['name']}}
					{{HTML::link("/setup_wizard/step2/".$device_data['detected_device']['id']."/false", "Setup Now", "class='btn btn-large'")}}
				</h3>
				<br><br><br><br>
				<p>					
					<button class="btn btn-info wrong-device-btn" >Wrong device ? </button></p>
				<br><br>
			</div>
		@endif

	@elseif($device_data['device_type'] == 'mobile')

		<div id="detected-device-is-mobile">
			<h2>Do you have a win/mac/linux? </h2>
			<button class="btn btn-info mobile-yes-os btn-large" >Yes</button>
			<button class="btn mobile-no-os btn-large">No</button>
		</div>

		<!-- yes have win/mac/linux -->
		<div id="pc-device-cn" style="display:none">
			<ul class="thumbnails">
				@foreach ($device_data['devices'] as $key => $value)
					@if($value->type == 'computer')
						<li class="span4">
							<div class="thumbnail text-center" >
								<img src="{{$value->picture_url}}" alt="">
								<h3>{{$value->name}}</h3>
								{{HTML::link("/setup_wizard/step2/".$device_data['detected_device']['id']."/false", "Setup Now", "class='btn btn-large'")}}
								<br>
								<br>
							</div>
						</li>
					@endif
				@endforeach
			</ul>
		</div>

		<!-- For detected Device -->
		@if(!empty($device_data['detected_device']))
			<div id="detected-device-mobile-cn" style="display:none">
				<h3 class="well">
					Your current device is {{$device_data['detected_device']['name']}}
					{{HTML::link("/setup_wizard/step2/".$device_data['detected_device']['id']."/false", "Setup Now", "class='btn btn-large'")}}
				</h3>
				<br><br><br><br>
				<p>					
					<button class="btn btn-info wrong-device-btn" >Wrong device ? </button></p>
				<br><br>
			</div>
		@endif
	@endif

	<!-- Display all device -->
	
	<div  id="all-device-list">
	    <ul class="thumbnails">
			@foreach ($device_data['devices'] as $key => $value)
				<li class="span4">
					<div class="thumbnail text-center" style="min-height:180px">
						<img src="{{$value->picture_url}}" alt="">
						<h3>{{$value->name}}</h3>
						{{HTML::link("/setup_wizard/step2/".$device_data['detected_device']['id']."/false", "Setup Now", "class='btn btn-large'")}}
						<br>
						<br>
					</div>
				</li>
			@endforeach
		</ul>
	</div>
	
	<!-- Javascript -->
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			@if(!empty($device_data['detected_device']))
				$("#all-device-list").hide();
			@endif

			$('.wrong-device-btn').click(function() {
				$('#all-device-list').show();
				$('#detected-device-pc-cn').hide();
				$('#detected-device-mobile-cn').hide();
			})

			$('.mobile-yes-os').click(function(){
				$('#pc-device-cn').show();
				$('#detected-device-is-mobile').hide();
			})

			$('.mobile-no-os').click(function(){
				$('#detected-device-mobile-cn').show();
				$('#detected-device-is-mobile').hide();
			})
		});
	</script>

@stop