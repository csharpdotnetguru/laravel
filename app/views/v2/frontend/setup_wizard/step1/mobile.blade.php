@include('frontend.setup_wizard.header')

<div class='container'>

	<h1>Step 1: Choose your Device</h1>

	<div id='mobile_question'>
		<div id='detected_device'>
			<p>You have 
				<b>
					@foreach($detected_devices as $detected_device) 
						{{ $detected_device->name }} 
					@endforeach
				</b>
			 Device
			 </p>
		</div>

		<div id='setup_wizard_comment'>
			<p>We recommend users to setup on PC device first</p>
		</div>

		<div id='setup_wizard_question'>
			<h3>Do you have access to a computer device like Windows, Mac, Linux?</h3>
		</div>


		<div id='setup_wizard_responses'>

			<div id='setup_pc'>
				<p> <a id='pc_click' href='#' class='filter' data-filter='.PC' >Yes, I want to setup on a PC now </a> </p>	
			</div>

			<div id='setup_detected_device'>
				<p>No, I want to setup on
					<ul>
					<b>
						@foreach($detected_devices as $detected_device) 
							<li>
								<a href="{{ route('setup_step2', ['device_id' => $detected_device->id]) }}">{{ $detected_device->name }}</a>
							</li>
						@endforeach
					</b>
					</ul>
				 </p>
			</div>

		</div>
	</div>



<script type="text/javascript">
	
	$(document).ready(function() {
		$('#pc_click').click(function () {
			console.log('test');
			$('#mobile_question').hide();
			$('#all_devices_container').css( { opacity: 1 });
		});

	});
</script>


	@include('frontend.setup_wizard.step1.devices')

</div>


