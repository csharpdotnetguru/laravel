<?php
$pageTitle = "Pricing and Signup for UnoDNS&#0153;";

	
$trial_button = "<a class='btn btn-primary' href='http://www.unotelly.com/unodns/signup' target='_BLANK'><i class='icon-time icon-white'></i> Free Trial</a>";
$buy_premium = "<a class='btn btn-primary' href='https://www.unotelly.com/portal/cart.php?gid=4' target='_BLANK'><i class='icon-shopping-cart icon-white'></i> Subscribe</a>";
$buy_gold = "<a class='btn btn-primary' href='https://www.unotelly.com/portal/cart.php?gid=5' target='_BLANK'><i class='icon-shopping-cart icon-white'></i> Subscribe</a>";

?>
@include('layout.old-unodns-header');

<style>
th, td { width: 25%; }
.bs_pricing_container {
padding: 0px 100px 0px 100px;
} 
</style>

<script>  
$(function (){ 
	$("#moneyback").popover(); 
	$("#trialperiod").popover();	
	$("#unohelper").popover();
	$("#ipupdateapi").popover();
	$("#bonusvpn").popover();
	$("#globaldns").popover();
	$("#network").popover();
	$("#dynamo").popover();
	$("#secure").popover();
	$("#computer").popover();
	$("#tv").popover();
	$("#mobile").popover();
	$("#router").popover();
	$("#hotel").popover();	
	$("#netflixus").popover();
	$("#netflixuk").popover();
	$("#netflixca").popover();
	$("#netflixie").popover();
	$("#netflixcr").popover();
});  


</script>




<!-- header no image -->    
    <div class="header_thin">
    	<div class="container_12">
        	    <div class="pricingTitle"><h1 align=center>100% Satisfaction Guarantee!</h1>
				<h2 align=center>"I was amazed at the speed of streaming on Hulu 
				with this application." <strong><a href="http://www.essentialmac.co.uk/featured/unotelly-becomes-unodns/">EssentialMac.co.uk</a></strong></h2>
				</div>
        </div>
    </div>
<!--/ header no image --> 

<!-- middle content -->
<div class="middle">
	<div class="bs_pricing_container">
    
	<div id="bootstrap_pricing">
			<table class="table table-striped">

					<thead>
						<tr>
							<th></th>
							<th>VPN/DNS Competitors</th>
							<th>UnoDNS Gold (+Bonus VPN)</th>
							<th>UnoDNS Premium</th>
						<tr>
					</thead>
					
					<thead>
						<tr>
							<th></th>
							<th>
							<?php echo $trial_button; ?>
							<?php echo $buy_gold; ?>
							</th>
							<th>
							<?php echo $trial_button; ?>
							<?php echo $buy_gold; ?>
							</th>
							<th>
							<?php echo $trial_button; ?>
							<?php echo $buy_premium; ?>
							</th>
						<tr>
					</thead>
					
					<thead>
						<tr>
							<th>Price per Month </th>
							<th>$4.99 (No VPN) - $17.99 (+VPN)</th>
							<th>$4.99 (+VPN) - 261% Cheaper***!</th>
							<th>$3.99 - 351% Cheaper****!</th>
						<tr>
					</thead>
					

					
					<tbody>
<!--
						<tr>
							<td><a href="#" id="moneyback" rel="popover" data-content="Unlike our competitors, 
							we are so confidennt about UnoDNS that we 
							offer 100% moneyback guarantee within 7 
							days of your payment no condition attached - simply ask for your moneyback!" 
							data-original-title="100% Moneyback">Moneyback Guarantee</a></td>
							<td>No</td>
							<td>7 Days 100% Moneyback</td>
							<td>7 Days 100% Moneyback</td>
						</tr>
-->
						<!--
						<tr>
							<td><a href="#" id="trialperiod" rel="popover" data-content="We offer you 8-day unlimited trial to
							trial UnoDNS. No credit card required to begin the trial." 
							data-original-title="8-day Unlimited Trial">Trial Period</a></td>
							<td>7 days</td>
							<td>8 days</td>
							<td>8 days</td>
						</tr>
						-->
						
<tr>
							<td><a href="#" target="_BLANK" id="dynamo" rel="popover" data-content="UnoDNS Dynamo allows you to change country of preference on the channels you watch. 
							For example, you can watch US, UK, Canada, Ireland Netflix in anywhere in the world. More importantly, you can watch UK Netflix on 
							one device and US Netflix on another device. UnoDNS Dynamo lets you do that!" 
							data-original-title="Change Media Country">Dynamo DNS</a></td>
							<td>No - Limited</td>
							<td>Yes </td>
							<td>Yes </td>
						</tr>
						
						<tr>
							<td><a href="#" id="netflixus" rel="popover" data-content="Watch the American version of Netflix no matter where you live using UnoDNS Dynamo!"
							data-original-title="Netflix USA">Netflix USA Anywhere</a></td>
							<td>Yes</td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>		
						
						<tr>
							<td><a href="#" id="netflixuk" rel="popover" data-content="Watch the British version of Netflix no matter where you live using UnoDNS Dynamo!"
							data-original-title="Netflix UK">Netflix UK Anywhere</a></td>
							<td>No</td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>
						
						<tr>
							<td><a href="#" id="netflixca" rel="popover" data-content="Watch the Canadian version of Netflix no matter where you live using UnoDNS Dynamo!"
							data-original-title="Netflix Canada">Netflix Canada Anywhere</a></td>
							<td>No</td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>

						<tr>
							<td><a href="#" id="netflixie" rel="popover" data-content="Watch the Irish version of Netflix no matter where you live using UnoDNS Dynamo!"
							data-original-title="Netflix Ireland">Netflix Ireland Anywhere</a></td>
							<td>No</td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>
						
						<tr>
							<td><a href="#" id="netflixcr" rel="popover" data-content="Watch the Brazil version of Netflix no matter where you live using UnoDNS Dynamo!"
							data-original-title="Netflix Brazil">Netflix Brazil Anywhere</a></td>
							<td>No</td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>	
						
						<tr>
							<td><a href="#" id="netflixcr" rel="popover" data-content="Watch the Panama version of Netflix no matter where you live using UnoDNS Dynamo!"
							data-original-title="Netflix Brazil">Netflix Panama Anywhere</a></td>
							<td>No</td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>
						
						<tr>
							<td><a href="http://www.unotelly.com/unodns/global" target="_BLANK" id="globaldns" rel="popover" data-content="How many UnoDNS server clusters do we have? 3? 5? Try tripling that! We have 
							over 12 DNS server clusters spanning across the world in all continents except Antartica. Our servers are positioned close to you to 
							give you
							 exceptionally low latency which means fast speed!" 
							data-original-title="12+ Global Coverage DNS Servers">Global DNS Clusters</a></td>
							<td>~2 in One-Region-Only</td>
							<td>12+ DNS Servers in 6 continents</td>
							<td>12+ DNS Servers in 6 continents</td>
						</tr>		

						<tr>
							<td><a href="http://www.unotelly.com/unodns/unocloud" target="_BLANK" id="network" rel="popover" data-content="UnoTelly operates over 100 servers so
							no matter where you are, no matter what system you're using,
							you're covered by our guarantee of maximum speed, reliability, and fail-proof redundancy!" 
							data-original-title="Fast & Secured Network">Redundant Network</a></td>
							<td>No - Limited</td>
							<td>Yes </td>
							<td>Yes </td>
						</tr>						
						
						<tr>
							<td><a href="#" id="unohelper" rel="popover" data-content="If you have a dynamic IP (typical in DSL/ADSL connection,
							 you are So-Out-of-Luck at our competitors because you will have to manually update your IP address or you
							  will lose access. Imagine you are forced to stop your Batman movie at the climax scene 
							  and asked to re-authenticate. Forunately, at UnoDNS, we have UnoHelper on Windows which will
							  automatically update your IP address to maintain
							   24/7 access with no interruption." 
							data-original-title="Maintain 24/7 connection">UnoHelper Automatic IP Update</a></td>
							<td>No</td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>
						
						<tr>
							<td><a href="#" id="ipupdateapi" rel="popover" data-content="If you want to update your IP address 
							without UnoHelper, you can use our IP Update API by running a cron job on DDWRT or your Unix machine." 
							data-original-title="Use cronjob to Update IP">Secure IP Update API</a></td>
							<td>No</td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>
						
						
						<tr>
							<td><a href="#" id="bonusvpn" rel="popover" data-content="Want to watch blocked content while travelling/3G/4G or simply 
							 want some secured privacy? Our Gold Package comes with Bonus VPN access of US and UK IP address!
							 " 
							data-original-title="Bonus Secured VPN Access">Bonus Secured VPN Access*</a></td>
							<td>No</td>
							<td>Yes*</td>
							<td>No</td>
						</tr>	


						<tr>
							<td><a href="#" id="hotel" rel="popover" data-content="Are you using mobile Internet or travelling in hotel? Bonus UnoVPN 
							will allow you to access blocked content using US or UK IP address and enhanced privacy."
							data-original-title="UnoVPN Support">Hotel/Public Wifi/3G/4G</a></td>
							<td>No</td>
							<td>Yes**</td>
							<td>No</td>
						</tr>

						

						

	

						<tr>
							<td><a href="#" id="computer" rel="popover" data-content="UnoDNS works on your Windows, Mac OSX, and Linux computer." 
							data-original-title="Full Computer Support">PC/Mac/Linux</a></td>
							<td>Yes</td>
							<td>Yes  </td>
							<td>Yes </td>
						</tr>

						<tr>
							<td><a href="#" id="tv" rel="popover" data-content="Xbox 360, PS3, Wii, Roku, WDTV Live, Boxee, Apple TV,
							LG Smart TV/BluRay, Sony Smart TV/BluRay, Toshiba Smart TV/BluRay, Dynex Smart TV/BluRay,
							Samsung Smart TV/BluRay, Google TV, and more..."
							data-original-title="Full TV Support">TV Devices</a></td>
							<td>Limited</td>
							<td>Yes  </td>
							<td>Yes </td>
						</tr>

						<tr>
							<td><a href="#" id="mobile" rel="popover" data-content="iPad, iPhone, iPod, Android"
							data-original-title="Full Mobile Support">Mobile Devices</a></td>
							<td>Limited</td>
							<td>Yes</td>
							<td>Yes </td>
						</tr>						
						
						<tr>
							<td><a href="#" id="router" rel="popover" data-content="Configure UnoDNS directly on your router so all devices connected can use
							 UnoDNS without any additional configuration!"
							data-original-title="Full Router Support">Router Devices</a></td>
							<td>Limited</td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>
						

						<tr>
							<td><a href="#" id="secure" rel="popover" data-content="All transaction are secured 
							by 256-bit encryption through Comodo SSL. Comodo SSL security certificate is trusted
							by over 99.3% of current Internet users and carries a $50,000 warranty." 
							data-original-title="256 bit Secured Encryption">Secured SSL Connections</a></td>
							<td>No - Limited</td>
							<td>Yes </td>
							<td>Yes </td>
						</tr>							

					<thead>
						<tr>
							<th></th>
							<th>
							<?php echo $trial_button; ?>
							<?php echo $buy_gold; ?>
							</th>
							<th>
							<?php echo $trial_button; ?>
							<?php echo $buy_gold; ?>
							</th>
							<th>
							<?php echo $trial_button; ?>
							<?php echo $buy_premium; ?>
							</th>
						<tr>
					</thead>
					
					</table>
<p>*Limited time offer; first-come, first-serve.</p>										
<p>**Access available through Bonus UnoVPN.</p>	
<p>***Based on 365-day subscription at $4.99 per month. Monthly price is $7.95 per month.</p>										
<p>****Based on 365-day subscription at $3.99 per month. Monthly price is $4.95 per month.</p>										
	

		</div>
		
		
	

	<div class="pricingBottom">
		 <div class="extra">
			<div class="rightcolumneven">
				<h3>Can I cancel any time?</h3>
				<p>Yes, you can cancel anytime and won't be billed again.</p>
				<h3>What types of payment do you accept?</h3>
				<p>Currently we accept Paypal, Visa, Mastercard. </p>

			</div>
			
			<div class="leftcolumneven">	
				<h3>Do I have to sign a long term contract?</h3>
				<p>No. UnoDNS&#0153; is a pay-as-you-go service. There are no long term contracts or commitments on your part. You simply pay according to the billing schedule you chose. </p>
				<h3>What devices work with UnoDNS&#0153;?</h3>
				<p>UnoDNS&#0153; Premium and Gold works for PC, Mac, PS3, Xbox 360, PS3, Wii, Android, iPad, AppleTV, Roku, and many other devices. <a href="http://www.unotelly.com/unodns/channels" target="_BLANK">Click here</a> to see the entire list. </p>
			</div>
			
			<div class="fullcolumn">
				<hr style="margin-bottom: 15px;">
				<img src="http://cdn.unotelly.com/unodns/images/secureIcon.png" width="75" height="75" alt="Your data is secure" align="left" />
				<h3>Your data and transaction are safe and secure</h3>
				<p>All transaction are secured by 256-bit encryption through Comodo SSL.  Comodo SSL security certificate is trusted by over 99.3% of current Internet users and carries a $50,000 warranty. </p>
				<hr style="margin-bottom: 20px;">
				<h3>Any questions before you sign up?</h3>
				<p>If you have questions about UnoDNS&#0153; or the sign up process just <a href="http://help.unotelly.com/support/tickets/new" target='_blank'>submit a support request</a> and we'll get right back to you.</p>
			</div>
		</div>
	</div>
		
		
				
        <!--/ content -->
        
        
        <div class="clear"></div>
        
        
    </div>
</div> 
<!--/ middle content -->


@include('layout.old-unodns-footer');
