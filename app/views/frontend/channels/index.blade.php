<?php
$pageTitle = "UnoDNS&#0153; Channels";


?>
@include('layout.old-unodns-header');
{{  HTML::script('assets/countUp/countUp.js')  }}

<script>


window.onload = function() {
	$.getJSON( "{{ route('channel_count') }}", function( data ) {
		console.log(data);
		var numAnim = new countUp("channel_count", 0, data, 0, 6);
		numAnim.start();
	});

}


</script>
{{  HTML::style('assets/css/sass/css/uno_style.css')     }}

       		
	<div class="middle">
		<div class="container_12">
		
		
			<!-- content -->
			
			<div class="submenu">
            	<ul>
                    <li><a href="http://www.unotelly.com/unodns/whatisunodns" >What is UnoDNS</a></li>
                    <li><a href="http://www.unotelly.com/unodns/features"  >Features</a></li>
					<li><a href="http://www.unotelly.com/unodns/unocloud"  >Global Network</a></li>	
                    <li><a href="http://www.unotelly.com/unodns/pricing" target="_blank" >Pricing</a></li>
                    <li><a href="http://www.unotelly.com/unodns/reviews" >Reviews</a></li>
                    <li><a href="http://www.unotelly.com/unodns/signup" class="selected">Try Now Free!</a></li>
                </ul>
            </div>
			<div class="">
			<div class="content"> 
				<div class="entry">
				
					
					
				

		<h1 class="page-header">Total number of channels: <span id="channel_count"></span></h1>
					

	


		@foreach($channels as $channel)
				<a href="{{ $channel->channel_url }}"><img src = "{{ $channel->image_url }}" /img></a>
		@endforeach


<table>
		@foreach($channels as $channel)
		<tr>
			<td><a href="{{ $channel->channel_url }}">{{ $channel->name }}</a></td>
			<td>{{ $channel->description }}</td>
		</tr>		
		@endforeach		
</table>

					

					
					
					<div class="col col_1_5 ">
					<div class="inner">
					<h3 class="title_blue"></h3>
					<p></p></div>
					</div>
					
					
					
					
					
					<div class="divider_thin"></div>
				
				</div>
						
			</div>
			</div>
		</div>
	</div>
</div>
        <!--/ content -->
        
        
        <div class="clear"></div>
        
        

<!--/ middle content -->

@include('layout.old-unodns-footer');
