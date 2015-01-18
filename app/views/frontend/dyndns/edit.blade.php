@extends('layout.test')

@section('content')
<h4>Edit DynDNS</h4>

@include('partials._notification')


{{ Form::open(['route' => ['dyndns_update', $dyndns_id], 'method' => 'PUT']) }}
 
 <p>
{{ Form::label('hostname', 'New Hostname') }}
{{ Form::text('hostname', Input::old('hostname')) }}
</p>


{{ Form::submit('Change Hostname', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
