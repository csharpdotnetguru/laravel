<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]>
<html class="no-js" lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="UnoTelly UnoDNS allows you to watch channels like Netflix, Hulu, BBC iPlayer, Channel 4oD, Pandora, Fox.com even if you don't live in USA or UK. Sign up for a free account now!"/>
    <meta name="author" content="UnoTelly Media Service"/>
    <meta name="keywords" content="vpn, proxy, hulu, netflix canada, netflix uk, netflix usa, how to watch netflix in uk, how to watch iplayer, how to watch 4od, how to watch channel4, how to watch hulu, how to watch netflix outside usa"/>
    <meta name="viewport" content="width=device-width">

    <title>UnoTelly SmartDNS and VPN @yield('title')</title>

    {{ HTML::style('https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,300,600|Montserrat:400,700') }}
    {{ HTML::style('assets/v2/lib/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('assets/v2/css/frontend.css') }}
    {{ HTML::style('assets/v2/css/responsive.css') }}

    {{ HTML::style('assets/alertify/themes/alertify.core.css') }}
    {{ HTML::style('assets/alertify/themes/alertify.default.css') }}

    @yield('stylesheets')

    @include('v2.frontend.partials._google-analytics')

    @if(!Agent::isMobile())
        @include('v2.frontend.partials._sharethis')
    @endif
</head>
<body>

<!-- Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- End of facebook -->

<!-- need to refactor this to show only in logged in member related pages -->
<!-- NOTE$tbergeron: Done, just need to add the content -->
@if((!isset($is_home)) )
    <div class="alert alert-success alert-no-margin announcement-top">
      <p class='anchor'></p>
    </div>


    @if($uid = Authenticate::is_logged_in()) 
        @if(Authenticate::is_user_confirmed($uid) === FALSE) 
            <div class="alert alert-danger alert-no-margin ">
                <p align='middle'>Please check your inbox to confirm your account. 
                <a class="btn btn-success btn-sm resend-confirmation" href="{{ URL::route('user_resend_confirmation') }}"><i class="glyphicon glyphicon-repeat"></i> Send Confirmation</a>
                </p>
            </div>


        @endif
    @endif


@endif

@include('partials._notification')




@yield('top_bar_quickstart')


@include('partials.app_info')

<div class='bg-overlay'></div>

@include('v2.frontend.session.partials.signup-modal')

<div id="main" class="main">
    @include('v2.frontend.partials._navbar')

    @yield('content')
</div>

<!-- External Librairies -->
{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js') }}
<script>window.jQuery || document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"><\/script>')</script>

{{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js') }}
{{ HTML::script('//cdn.jsdelivr.net/slidesjs/3.0.4/jquery.slides.min.js') }}

<script>
    var back_url = '@if(Authenticate::is_logged_in()){{ route('quickstart_index') }}@else{{ route('home') }}@endif';
</script>
{{ HTML::script('assets/v2/js/all-pages.js') }}

<!-- 3rd Party librairies -->
{{ HTML::script('assets/v2/lib/jquery.marquee.min.js') }}
{{ HTML::script('assets/v2/lib/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('assets/alertify/lib/alertify.min.js') }}

@yield('scripts')

@yield('scripts_from_partials')

<script type="text/javascript">

    $(function() {
        setTimeout(function(){
            var el = $('#sthoverbuttons');
            el.attr('data-step', 8);
            el.attr('data-intro', 'Lastly, please share about UnoTelly. We really appreciate it!');
        },3000);

        // NOTE: Removed console.log for production (console.log breaks in older IEs)
        var annnouncementLink = '{{ route('get_announcement') }}';
        $.getJSON(annnouncementLink, function (data) {
//            console.log(data);
            if(data.status == true) {
//                console.log('Display Announcement');
                var aLength = data.data.length;
                var el = $('.announcement-top');
                for(var i = 0; i < aLength; i++) {
//                    console.log(data.data[i].content);
                    el.find('p.anchor').append(data.data[i].content);
                }
                el.show();

            }
            else {
//                console.log('no announcement');
            }
        });

    });

</script>

</body>
</html>