@extends('layout.test')

@section('content')
<h2>Edit Network</h2>

@include('partials._notification')
<!-- Removed uid parameter -->
{{ Form::open(['route' => ['network_update', $network->id], 'method' => 'PUT']) }}
{{ Form::hidden('network_id', $network->id) }}


<p>
{{ Form::label('network_name', 'Network Name') }}
{{ Form::text('network_name', $network->ip_label) }}
</p>

<p>
{{ Form::label('ip_address', 'IP Address') }}
{{ Form::text('ip1', $splited_ip[0], array('maxlength' => '3','class' =>'autotab ipbox')) }} .
{{ Form::text('ip2', $splited_ip[1], array('maxlength' => '3','class' =>'autotab ipbox')) }} .
{{ Form::text('ip3', $splited_ip[2], array('maxlength' => '3','class'  =>'autotab ipbox')) }} .
{{ Form::text('ip4', $splited_ip[3], array('maxlength' => '3','class' =>'autotab ipbox')) }}
</p>


{{ Form::label('ip_status', 'Activate',null,['class'=>'span'])}}

{{ Form::checkbox('ip_status', 1, true) }}

{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

@stop