<?php
$pageTitle = "UnoDNS&#0153; Reviews";


?>
@include('layout.old-unodns-header');

       		
	<div class="middle">
		<div class="container_12">
				<div class="pricingTitle"><h1 align="left">UnoDNS - Reviews</h1></div>
	
		
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

				

            <div class="fbox">
                <div id="fBox1" class="fBox1">					

@foreach($reviews as $review)					
<div class='review_box'>

	<div class='left_box'>
		<img src='http://www.unotelly.com/unodns/{{ $review->image }}' class='NRimg' alt='' />
	</div>


	<div class='right_box'>

		<h3>
			<a href='{{ $review->url }}'>{{ $review->blog_name }}</a><br />
		</h3>

		<p>
			{{ $review->snippet }} &ndash;
			<i><b> {{ $review->author }} </i></b>
			<br /><br />
		</p>

		<div class='flearnmore'>
			<a href="{{ $review->url }}">{{ $review->url }}</a>
		</div>

	</div>

	<div class='vLine padd10'>&nbsp;</div>

</div>

@endforeach





					
					
					
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
