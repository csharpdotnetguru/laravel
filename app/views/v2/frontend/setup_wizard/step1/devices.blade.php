

<div id='all_devices_container' >

	<div id='what_device_question'>
		<h2>What device would you like to setup?</h2>
	</div>


	<div id='buttons'>
		
		<ul>
			<li class="filter" data-filter="all">Show All</li>
			<li class="filter" data-filter="none">None</li>
			<li class="filter" data-filter=".PC">PC</li>
			<li class="filter" data-filter=".mobile">Mobile</li>
			<li class="filter" data-filter=".gaming">Gaming</li>
			<li class="filter" data-filter=".home">Home</li>
			<li class="sort" data-sort="default">Default</li>
			<li class="sort" data-sort="myorder:asc">Ascending</li>
			<li class="sort" data-sort="myorder:desc">Descending</li>
			<li class="sort" data-sort="random">Random</li>
		</ul>


	</div>

	<div id="Container">

		@foreach($pc_devices as $pc_device)

			<a href="{{ route('setup_step2', ['device_id' => $pc_device->id]) }}">
				<div class="mix {{ $pc_device->type }} device_box" data-myorder="{{ rand(1,10) }}">
					<p class='device_box_text'> {{ $pc_device->name }} </p>
				</div>
			</a>
		@endforeach


		@foreach($mobile_devices as $mobile_device)

			<a href="{{ route('setup_step2', ['device_id' => $mobile_device->id]) }}">		
				<div class="mix {{ $mobile_device->type }} device_box" data-myorder="2">
					<p class='device_box_text'> {{ $mobile_device->name }} </p>
				</div>
			</a>

		@endforeach

		@foreach($home_devices as $home_device)
			
			<a href="{{ route('setup_step2', ['device_id' => $home_device->id]) }}">
				<div class="mix {{ $home_device->type }} device_box" data-myorder="2">
					<p class='device_box_text'> {{ $home_device->name }} </p>
				</div>
			</a>
		@endforeach

		@foreach($gaming_devices as $gaming_device)

			<a href="{{ route('setup_step2', ['device_id' => $gaming_device->id]) }}">
			<div class="mix {{ $gaming_device->type }} device_box" data-myorder="2">
				<p class='device_box_text'> {{ $gaming_device->name }} </p>
			</div>
			</a>

		@endforeach
	</div>

</div>


<style>
#Container .mix{
	display: none;
}

#all_devices_container {
	background-color: #bdc3c7;
	opacity: 0;
}

#buttons ul {
	list-style-type:none;
}

#buttons li {
	display: inline;
}

#buttons {
	width: 600px;
}

.device_box {
	margin: 10px;
	color: #ffffff;
	opacity: .65;
}

.pc {
	background: #c0392b;
	width: 300px;
	height: 60px;
}

.mobile {
	background: #8e44ad;
	width: 300px;
	height: 60px;
}

.home {
	background: #27ae60;
	width: 300px;
	height: 60px;
}

.gaming {
	background: #2980b9;
	width: 300px;
	height: 60px;
}
</style>

<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
<script type="text/javascript">
	$(function(){

		// Instantiate MixItUp:

		$('#Container').mixItUp();

	});
</script>