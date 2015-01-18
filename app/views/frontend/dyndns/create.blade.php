@extends('layout.test')

@section('content')
<h4>New DynDNS</h4>

@include('partials._notification')

{{ Form::open(['route' => ['dyndns_store'], 'method' => 'POST']) }}
 
 <p>
{{ Form::label('hostname', 'Hostname') }}
{{ Form::text('hostname', Input::old('hostname')) }}
</p>


{{ Form::submit('Add Hostname', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop