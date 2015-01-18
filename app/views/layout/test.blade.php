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

<body>

@include('partials.app_info')

<div id="top_banner" class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <p align="middle" class="alert-heading">UnoTelly Android App Available - Download from <a href='https://play.google.com/store/apps/details?id=com.app.unotelly' target='_BLANK'>Google Play</a></p>
</div>

@yield('status')

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            @include('partials._navbar')
        </div>
    </div>

    <div class="uno_box">
        <div class="size3 content-container">
            @include('partials._sidebar')
        </div>
        <div class="size9 content-main-display">
            @yield('content')
        </div>
    </div>

    <div class="size12" style="margin-bottom:50px">
        <hr style="margin-bottom:10px">
        <p class="muted pull-right">Copyright Unotelly © {{ date('Y') }} - {{ ReleaseHelper::getReleaseNumber() }}</p>
    </div>

</div>


<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

</body>
@stop