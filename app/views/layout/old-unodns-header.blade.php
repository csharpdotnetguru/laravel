<?php
if( isset($_COOKIE['user_hash']) ) {
	//header('Location: http://quickstart3.unotelly.com/');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>







<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="canonical" href="http://www.unotelly.com" />
<title><?php print "$pageTitle";?></title>
<meta name="author" content="UnoTelly Media Service" />
<meta name="description" content="UnoDNS allows you to watch channels like Netflix, Hulu, BBC iPlayer, Channel 4oD, Pandora, Fox.com even if you don't live in USA or UK. Sign up for a free account now!" />
<meta name="keywords" content="vpn, proxy, hulu, netflix canada, netflix uk, netflix usa, how to watch netflix in uk, how to watch iplayer, how to watch 4od, how to watch channel4, how to watch hulu, how to watch netflix outside usa" />

<link href="https://www.unotelly.com/unodns/styles/formBuilder.css" media="screen" rel="stylesheet" type="text/css" />
<link href="https://www.unotelly.com/unodns/style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="https://www.unotelly.com/unodns/styles/pricing.css" media="screen" rel="stylesheet" type="text/css" />
<link href="https://www.unotelly.com/unodns/styles/features.css" media="screen" rel="stylesheet" type="text/css" />
<link href="https://www.unotelly.com/unodns/bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />

<!--slider-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://www.unotelly.com/unodns/bootstrap/js/bootstrap.min.js"></script>
<script src="https://www.unotelly.com/unodns/js/jquery.easing.1.3.js"></script>
<script src="https://www.unotelly.com/unodns/js/slides.jquery.js"></script>



<script type="text/javascript" src="https://www.unotelly.com/unodns/js/jquery.idTabs.min.js"></script>

<!--Video Pop Up-->
	<link type="text/css" rel="stylesheet" href="https://www.unotelly.com/unodns/styles/jquery.fancybox-1.3.4.css" />
	<script type="text/javascript" src="https://www.unotelly.com/unodns/js/jquery.fancybox-1.3.4.pack.js"></script>
		<script>
		$(document).ready(function(){
				$("a.iframe").fancybox({
					'width' : 600
				});

		});
		</script>
<!--Video Pop Up-->

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]-->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23362412-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>






<!--Tooltip -->
<script type="text/javascript" src="https://www.unotelly.com/unodns/js/jquery.qtip.min.js"></script>
<link href="https://www.unotelly.com/unodns/css/jquery.qtip.min.css" media="screen" rel="stylesheet" type="text/css" />

<script>
$(document).ready(function()
{
	$('a.free').qtip({
	   content: {
		  text: 'Loading...', // The text to use whilst the AJAX request is loading
		  ajax: {
			 url: 'includes/channels/free_mini.php', // URL to the local file
			 type: 'GET', // POST or GET
			 data: {} // Data to pass along with your request
		  }
	   },
	   style: {
		classes: 'ui-tooltip-shadow ui-tooltip-rounded '

	   }
	});


	$('a.premium').qtip({
	   content: {
		  text: 'Loading...', // The text to use whilst the AJAX request is loading
		  ajax: {
			 url: 'includes/channels/premium_mini.php', // URL to the local file
			 type: 'GET', // POST or GET
			 data: {} // Data to pass along with your request
		  }
	   },
	   style: {
		classes: 'ui-tooltip-shadow ui-tooltip-rounded '
	   }
	});

	$('a.gold').qtip({
	   content: {
		  text: 'Loading...', // The text to use whilst the AJAX request is loading
		  ajax: {
			 url: 'includes/channels/gold_mini.php', // URL to the local file
			 type: 'GET', // POST or GET
			 data: {} // Data to pass along with your request
		  }
	   },
	   style: {
		classes: 'ui-tooltip-shadow ui-tooltip-rounded '
	   }
	});




});
</script>
<!--end tooltip-->

<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ur-48e85e24-10e7-398e-ee24-40501f5698b"}); </script>
</head>

<!--
<div id="" class="alert alert-danger">
  <a class="close" data-dismiss="alert" href="#">×</a>
	  <h3 align="middle" class="alert-heading">Update Oct 12, 2012: Netflix USA is blocking Non-US Netflix account. We recommend you to <a href="https://movies.netflix.com/YourAccount">Cancel</a> your local Netflix account and sign up a <a href="http://help.unotelly.com/solution/articles/9578-how-to-sign-up-for-a-netflix-usa-account">Netflix USA account</a>. No action is required if you have a Netflix USA account.</h3>
</div>
-->


<div id="loading" class="alert alert-success">
<style>
#loading {

margin:0;
padding: 0;
}
</style>

  <a class="close" data-dismiss="alert" href="#"></a>
	  <br />
	 <p align="middle">
	  <span class='st_sharethis_hcount' displayText='ShareThis'></span>
		<span class='st_pinterest_hcount' displayText='Pinterest'></span>
		<span class='st_facebook_hcount' displayText='Facebook'></span>
		<span class='st_twitter_hcount' displayText='Tweet'></span>
		<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
		<span class='st_email_hcount' displayText='Email'></span>
	</p>

</div>



<noscript>
<div id="noscript">
		<p class="noscript">Warning: Javascript is disabled; Please enable javascript to view this page. </p>
</div>
</noscript>
<!--social header -->






<div class="head_bar">

	<div class="container_12">

        <div class="logo"><a href="https://www.unotelly.com"><img src="https://www.unotelly.com/unodns/images/logo.png" alt="" width="255" height="42" border="0" /></a>



		</div>


        <div class="topmenu">

        	<ul class="dropdown">
			<!--
				<div class="countries">
								<ul>
									<li><img src="images/countries/de.png"</> DE</li>
									<li><img src="images/countries/fr.png"</> FR</li>
									<li><img src="images/countries/es.png"</> ES</li>
									<li><img src="images/countries/us.png"</> EN</li>
								</ul>
				</div>

			-->




            	<li><a href="http://www.unotelly.com/unodns/whatisunodns"><span>What is UnoDNS&#0153;</span></a>
<!--
				<ul>
						<li><a href="whatisunodns"><span>What is it?</span></a></li>
                        <li><a href="features"><span>Features</span></a></li>
                        <li><a href="channels"><span>Channels</span></a></li>
						<li><a href="#footer-form"><span>UnoClouds&#0153;</span></a></li>
						<li><a href="techspecs"><span>Tech Specs</span></a></li>

					</ul>

-->
                </li>

				<!--
                <li><a href="#reviews_anchor"><span>Reviews</span></a></li>
                -->
				<li><a href="http://www.unotelly.com/unodns/channels"><span>Channels</span></a></li>
				<li><a href="http://www.unotelly.com/unodns/reviews"><span>Reviews</span></a></li>
				<li><a href="http://help.unotelly.com/solution/categories"><span>FAQs</span></a></li>
				<li><a href="http://www.unotelly.com/unodns/pricing"><span>Pricing</span></a></li>
				<li><a href='http://quickstart.unotelly.com/'>Quick Start</a></li>
                <li class='current-menu-ancestor'><a href="http://www.unotelly.com/unodns/signup"><span>Try for Free</span></a></li>
                <li class='current-menu-ancestor'><a href="http://quickstart3.unotelly.com/login"><span>Customer Login</span></a></li>


            </ul>
        </div>
    </div>
</div>








