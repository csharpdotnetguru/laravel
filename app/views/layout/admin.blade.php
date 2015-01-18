@extends('layout.master')
@section('master_content')
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="/assets/scripts/script.js" type="text/javascript"></script>
    <script>
        var updateAjax='{{URL::route('updateAjax')}}'
        var network_create="{{URL::route('admin_network_create')}}";
    </script>
    <title>@yield('title')</title>
    {{HTML::style('/assets/css/style.css')}}
    @yield('headContent')
</head>
<body>
@include('partials.header')
<div class="mainContent">
    @yield('content')
</div>
<div class="footer">
    @include('partials.footer')
</div>
</body>
@stop