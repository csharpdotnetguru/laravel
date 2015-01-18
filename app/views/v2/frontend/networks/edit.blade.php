@extends('layout.v2.home')

@section('stylesheets')
	{{  HTML::style('assets/css/style.css') }}
@stop

@section('title', ' | Networks')

@section('content')
		<?php
		$index = 0;
		?>
<div class="container main-content">

    @include('v2.frontend.partials._back-button')
    <h1>Edit Network</h1>

@include('partials._notification')

	<section>

@include('partials._notification')
<!-- Removed uid parameter -->
{{ Form::open(['route' => ['network_update', $network->id], 'method' => 'PUT']) }}
{{ Form::hidden('network_id', $network->id) }}

    <div class="form-group">
        {{ Form::label('network_name', 'Network Name') }}
        {{ Form::text('network_name', $network->ip_label, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('ip_address', 'IP Address') }}
        <div>
            {{ Form::text('ip1', $splited_ip[0], array('maxlength' => '3', 'class'=>'form-control autotab ipbox')) }} .
            {{ Form::text('ip2', $splited_ip[1], array('maxlength' => '3', 'class'=>'form-control autotab ipbox')) }} .
            {{ Form::text('ip3', $splited_ip[2], array('maxlength' => '3', 'class'=>'form-control autotab ipbox')) }} .
            {{ Form::text('ip4', $splited_ip[3], array('maxlength' => '3', 'class'=>'form-control autotab ipbox')) }}
        </div>
    </div>

    <div class="checkbox">
        <label for="ip_status">
            {{ Form::checkbox('ip_status', 1, true) }} Activate
        </label>
    </div>

    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

    </section>

</div>

@include('v2.frontend.partials._footer')

	@section('scripts')
		<script>
	        var dynamoIndex='{{URL::route('dynamo_index',['uid'=>Authenticate::get_uid()])}}';
	        var dynamoUpdate='{{URL::route('dynamo_update',['uid'=>Authenticate::get_uid()])}}';
	        var updateAjax='{{URL::route('updateAjax',['uid'=>Authenticate::get_uid()])}}';
		</script>

	    {{  HTML::script('assets/scripts/script.js')  }}

	@stop
@stop