@extends('layout.master')
@section('master_content')
@include('partials._userHead')

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23362412-1']);
  _gaq.push(['_setDomainName', 'unotelly.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!--<div id="all_active" class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 align="middle" class="alert-heading">UnoDNS Setup and Account are active.</h4>

    <br/>

    <p align="middle">
        <a class='btn btn-primary' href='channels.php'>Watch on PC/Mac</a>
        <a class='btn btn-primary' href='index.php#setup'>Setup Additional Devices</a>
        <a class='btn btn-primary' href='dyn_settings.php'>Change Country Preference(Public BETA)</a>
        <a class='btn btn-primary' href='http://help.unotelly.com/solution/categories/9628/folders/25818'
           target="_BLANK"><i class="icon-off icon-white"></i> Turn off UnoDNS</a>
    </p>
    <br/>

    <br/>

    <p align="middle">
        <span class='st_sharethis_hcount' displayText='ShareThis'></span>
        <span class='st_pinterest_hcount' displayText='Pinterest'></span>
        <span class='st_facebook_hcount' displayText='Facebook'></span>
        <span class='st_twitter_hcount' displayText='Tweet'></span>
        <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
        <span class='st_email_hcount' displayText='Email'></span>
    </p>
</div>

<div id="dns_false" class="alert alert-error">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 align='middle' class="alert-heading">UnoDNS Setup is incomplete. Please complete UnoDNS setup. </a></h4>
    <br/>

    <p align="middle"><a class='btn btn-primary'
                         href='http://help.unotelly.com/support/solutions/articles/27287-i-m-getting-the-unodns-setup-is-incomplete-please-complete-unodns-setup-message'><i
                class="icon-info-sign icon-white"></i> Troubleshoot</a></p>

    <p align="middle">If you are still having trouble, please <a href="http://help.unotelly.com/support/tickets/new"
                                                                 target="_BLANK">contact support</p>
</div>

<div id="account_expired" class="alert alert-error">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 align="middle" class="alert-heading">UnoDNS Setup is ok but your account has expired. (Wrong account? <a
            href="http://www.unotelly.com/quickstart2/update_ip.php">Log in</a> to your account)</h4>
    <br/>

    <p align="middle">
        <a class='btn btn-primary' href='http://www.unotelly.com/unodns/pricing' target="_BLANK"><i
                class="icon-shopping-cart icon-white"></i> Purchase a Subscription</a>
        <a class='btn btn-primary' href='http://www.unotelly.com/portal' target="_BLANK"><i
                class=" icon-circle-arrow-up icon-white"></i> Renew Account</a>
        <a class='btn btn-primary' href='http://help.unotelly.com/solution/categories/9628/folders/25818'
           target="_BLANK"><i class="icon-off icon-white"></i> Turn off UnoDNS</a>
    </p>
</div>

<div id="unknown_user" class="alert alert-error">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 align="middle" class="alert-heading">UnoDNS Setup is ok but please update your IP address.</h4>
    <br/>

    <p align="middle"><a class='btn btn-primary' href='update_ip.php'>Update IP Address</a>
        <a class='btn btn-primary' href='http://help.unotelly.com/solution/categories/9628/folders/25818'
           target="_BLANK"><i class="icon-off icon-white"></i> Turn off UnoDNS</a>
    </p>

</div>
-->
<body>


<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div>
    @yield('content')
</div>
@stop