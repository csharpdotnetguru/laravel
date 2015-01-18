@extends('layout.v2.home')

@section('title', ' | DynDNS')

@section('content')

<div class="container main-content">
    @include('v2.frontend.partials._back-button')
    <section>
        <div class="row">
            <div class="col-xs-12">
                <h1>Edit DynDNS</h1>
                <h4>Hostname: {{ $hostname }}</h4>

                <br/>

                @include('partials._notification')


                {{ Form::open(['route' => ['dyndns_update', $dyndns_id], 'method' => 'PUT']) }}

                <p>
                    {{ Form::label('hostname', 'New Hostname') }}
                    {{ Form::text('hostname', Input::old('hostname')) }}
                </p>


                {{ Form::submit('Change Hostname', array('class' => 'btn btn-primary')) }}

                <a class="btn btn-link" href="{{ URL::route('dyndns_index') }}">Cancel</a>

                {{ Form::close() }}
            </div>
    </section>
</div>

@include('v2.frontend.partials._footer')

@stop
