@extends('layout.v2.home')

@section('stylesheets')

	<!-- Grid-Page-Common-CSS -->
	@include('v2.frontend.partials._grid-page-common-css')
	<!-- End of Grid-page-common-css -->


@stop

@section('content')

<style>
body {
  background: url( "{{ asset("assets/v2/images/background/wc1.jpg") }}" );
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; 
background-attachment: fixed;

}

div.wc-title-block {
	background: #e74c3c url('{{ asset("assets/v2/images/icons/Soccer-128.png") }}') left no-repeat;
	height: 50px;
	background-size: 100px;
}

.font-white {
	color: #fff;
	padding-top: 10px;

}

.wc-setup-steps {
	background-color: #ecf0f1;
	padding-top: 30px;
	padding-bottom: 30px;
}

.hidden-content {
	display: none;
}


</style>



<div class='hidden-content'>

</div>
<div class="remodal channel" data-remodal-id="modal"> <!-- Content to be insert via Ajax --> </div>

<div class="container main-content">

<div id='test123'></div>

	<div class='row'>
	  	<div class="col-sm-6">

			<h2 class='page-header text-center'>How to watch World Cup 2014 Free</h1>

			<div class='center-block' id='wc-tutorial'>
				
			</div>


			<div>
				<h2 class='page-header'>Share your thoughts</h1>
				<div id="disqus_thread"></div>
			    <script type="text/javascript">
			        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
			        var disqus_shortname = 'unotelly'; // required: replace example with your forum shortname

			        /* * * DON'T EDIT BELOW THIS LINE * * */
			        (function() {
			            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			        })();
			    </script>
			    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
			</div>
		</div>

		<div class='col-sm-6'>
			<div class='wc-title-block'>			
				<h2 class='page-header text-center font-white'>
				UPCOMING MATCHES
				</h3>
			</div>

			<table class="table table-hover">
				<th>Time</th>
				<th>Teams</th>
				<th>Live Streams</th>


@if(!empty($matches)) 
	@foreach ($matches as $match) 
		
				<tr>
					<td><span data-localtime-format>{{ $match->match_time }}</span>
						<p><small>({{ $match->hours_count_down }} until kickoff)</small></p>
</td>
					<td>
						<div>
							<img class="country-flag" src="{{ asset('assets/v2/images/flags/32/') }}/{{ $match->teams[0] }}.png">
							-
							<img class="country-flag" src="{{ asset('assets/v2/images/flags/32/') }}/{{ $match->teams[1] }}.png">
						</div>
					<td>
					<ul>
						@foreach($match->channels as $channel)
						<?php 

						$a = explode(',', $channel);

						?>
						@if(isset($a[0]) AND isset($a[1]))
							<li>
								<span class='devices'>
									<a href="http://www.nullrefer.com/?{{trim($a[1])}}" class='' >{{$a[0]}}</a>
								</span>
							</li>
						@else 
							<li>To be updated</li>
						@endif
						@endforeach
					</ul>
					</td>
				</tr>
	@endforeach
@endif

	

				


			</table>
		</div>

	</div>

</div>	


@section('scripts')
	<!--Page Grid Page Common JS Assets !-->
	<!-- End of Grid Page Common JS Assets -->
	<script src="{{ asset('assets/v2/lib/localtime/src/jquery.localtime.js') }}"></script>

	<script type="text/javascript">
		
		$( document ).ready(function() {
			
			// var a = $('.article-body').html();
			// console.log(a);

			$.ajax({
			    type: "GET",
			    url: "{{ URL::route('wc2014_content') }}",
			}).success( function( data ) {
			    var wcContent = $(data).find('.article-body');
			   	$('#wc-tutorial').html(wcContent);

			});


		});

	</script>
	
@stop



@stop