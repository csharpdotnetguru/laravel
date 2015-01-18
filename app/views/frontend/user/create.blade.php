<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>UnoDNS&trade; Premium free trial - 100% Premium Experience</title>
    <meta name="author" content="UnoTelly Media Service"/>
    <meta name="description"
          content="UnoDNS allows you to channels like Netflix, Hulu, BBC iPlayer, Channel 4oD, Pandora, Fox.com even if you don't live in USA or UK. Sign up for a free account now!"/>
    <meta name="keywords"
          content="vpn, proxy, hulu, netflix canada, netflix uk, netflix usa, how to watch netflix in uk, how to watch iplayer, how to watch 4od, how to watch channel4, how to watch hulu, how to watch netflix outside usa"/>

    <link rel="canonical" href="https://www.unotelly.com"/>

    <link href="https://www.unotelly.com/unodns/style.css" media="screen" rel="stylesheet" type="text/css"/>
    <link href="https://www.unotelly.com/unodns/styles/formBuilder.css" media="screen" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.unotelly.com/unodns/js/jquery.lightbox_me.js"></script>
    <script type="text/javascript" src="https://www.unotelly.com/unodns/js/jquery.validate.min.js"></script>
    <link href="bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css"/>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#form_195827").validate();
            $('a#trynow').click(function () {
                $('#form_container').lightbox_me({
                    centered: true,
                    onLoad: function () {
                        $('#form_container').find('input:first').focus()
                    }
                });
                return false;
            });
        });
    </script>

    <style>
        #form_container {
            -moz-box-shadow: 0 0 5px 5px #888;
            -webkit-box-shadow: 0 0 5px 5px #888;
            box-shadow: 0 0 5px 5px #888;
            display: none;
        }

        .error {
            color: red;
        }

    </style>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-23362412-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

    </script>

    <script type="text/javascript">var switchTo5x = false;</script>
    <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "ur-48e85e24-10e7-398e-ee24-40501f5698b"}); </script>

</head>

<body>
@include('partials.app_info')

<noscript>
    <div id="noscript">
        <p class="noscript">Warning: Javascript is disabled; Please enable javascript to view this page. </p>
    </div>
</noscript>

<div id="form_container">

    <form id="form_195827" class="appnitro" method="post" action="{{ URL::route('user_store') }}">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <ul>
            <h1 align="center">Try UnoDNS&trade; free for 8-day</h1>

            <!--<span align="center">Watch over 9 unlimited Channels</span> -->

            <li id="li_1">
                <label class="description" for="element_1">First Name <img
                        src="https://www.unotelly.com/unodns/images/questionmark.png"
                        title="Enter your name so we can say hello"></img></label>

                <div class="freeHtml">
                    <input id="element_1" name="firstname" class='required' title='Please Enter First Name' type="text"
                           maxlength="500" value=""/>
                </div>
            </li>

            <li id="li_2">
                <label class="description" for="element_2">Email <img
                        src="https://www.unotelly.com/unodns/images/questionmark.png"
                        title="Your e-mail address will be used to log in"></img></label>

                <div class="freeHtml">
                    <input id="element_2" name="email" class='required email' title='Please enter a Valid Email'
                           type="text" maxlength="255" value=""/>
                </div>
            </li>

            <li id="li_3">
                <label class="description" for="element_3">Password <img
                        src="https://www.unotelly.com/unodns/images/questionmark.png"
                        title="Please enter your password"></img></a></label>

                <div class="freeHtml">
                    <input id="element_3" name="password" class='required' title='Please enter a Password'
                           type="password" maxlength="255" value=""/>
                </div>
            </li>

            <li class="buttons">
                <button class="awesome" type="submit" id="signUp" value="Sign Up">Create My Account</button>
            </li>
            <br/>

            <p class="tos" align="center">By clicking this button, you agree to UnoTelly's <a href="https://www.unotelly.com/unodns/tos"
                                                                                              target="_BLANK">Terms of
                    Service.</a></p>
        </ul>
    </form>

</div>

<!-- header no image -->
<div class="header_thin">
    <div class="signup">

        <div class="pricingTitle"><h1 align=center>UnoDNS&trade; Premium 8-day free trial</h1>
        </div>

    </div>

    @include('partials._notification')

</div>
<!--/ header no image -->

<div class="middle">
    <div class="container_12">

        <div class="col col_2_3 ">
            @if(isset($messages))
            @foreach($messages as $field => $message)
            <p style="color:red">{{ $message[0] }}</p>
            @endforeach
            @endif

            <h2 class='signupMidTitle'>Your <span class="signupP">UnoDNS&trade; Premium 8-day free trial</span> will
                give you access to
                the <span class="signupP">full UnoDNS&trade; experience</span> without commitment, no credit card
                required.</h2>
            <!--
            <p class='disclaimer'>*Bonus UnoVPN is not included</p>	-->
            <a id='trynow' href='#'><img src="https://www.unotelly.com/unodns/images/trybutton.png"/></a>

            <div class="signupMid">

                <h2>So many devices</h2>

                <img src="https://www.unotelly.com/unodns/images/devices/mini/pc.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/mac.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/linux.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/xbox360.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/ps3.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/wii.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/roku.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/atv.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/boxee.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/wdtv.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/tv.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/bluray.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/iphone.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/galaxy.png" width=100></img>
                <img src="https://www.unotelly.com/unodns/images/devices/mini/ipad.png" width=100></img>

                <br/>
                <br/>

                <h2>So many channels</h2>

                @foreach($channels as $channel)
                <a href="{{ $channel->channel_url }}" target="_blank"><img src="{{ $channel->image_url }}"/></a>
                @endforeach

                <div id='trycenter'><a id='trynow' href='#'><img
                            src="https://www.unotelly.com/unodns/images/trybutton.png"/></a></div>

            </div>
        </div>

        <div class="col col_1_3">
            <div class="inner">

                <div class="col box box_border box_yellow">

                    <div id="checkListTitle">
                        <h1>UnoDNS&trade; Premium Checklist</h1>
                    </div>

                    <div class="checkListBody">
                        <p><img class='check' src="https://www.unotelly.com/unodns/images/icons/icon_check.png"
                                width="20" alt=""/>Full UnoDNS&trade; access</p>
                        <!--
                        <p><img class='check'src="https://www.unotelly.com/unodns/images/icons/icon_check.png" width="20"  alt="" />Bonus UnoVPN&trade; access</p>
								-->
                        <p><img class='check' src="https://www.unotelly.com/unodns/images/icons/icon_check.png"
                                width="20" alt=""/>Works on computer</p>

                        <p><img class='check' src="https://www.unotelly.com/unodns/images/icons/icon_check.png"
                                width="20" alt=""/>Works on TV</p>

                        <p><img class='check' src="https://www.unotelly.com/unodns/images/icons/icon_check.png"
                                width="20" alt=""/>Works on smartphone</p>

                        <p><img class='check' src="https://www.unotelly.com/unodns/images/icons/icon_check.png"
                                width="20" alt=""/>Works on tablet</p>
                        <br/>
                        <a id='trynow' href='#'><img src="https://www.unotelly.com/unodns/images/trybutton.png"/></a>

                    </div>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <p align='center'>Copyright &copy; 2012 UnoDNS&trade;, UnoTelly&trade;, Unovation Inc.</p>

    </div>

</div>
<div class="clear"></div>

</body>
</html>