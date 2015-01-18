@extends('layout.master')
@section('master_content')
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="/assets/scripts/script.js" type="text/javascript"></script>
    <script>
        var updateAjax='{{URL::route('updateAjax')}}'
    </script>
    <title>@yield('title')</title>
    @yield('headContent')
</head>
<body>
@include('partials.user_header')
<div class="mainContent">
    @yield('content')
</div>
<div class="footer">
</div>
</body>
@stop
