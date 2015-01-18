@extends('layout.test')



@section('headContent')
@stop

@section('content')
<?php
$index = 0;
?>
<!--<form id="channel_update" method="POST" action="/dynamo/edit">-->
@include('partials._notification')
@include('frontend.dynamo.form')
@stop