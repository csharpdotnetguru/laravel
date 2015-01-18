@extends('layout.v2.home')

@section('stylesheets')
	{{  HTML::style('assets/css/style.css') }}
@stop

@section('content')
		<?php
		$index = 0;
		?>
<div class="container main-content">

    @include('v2.frontend.partials._back-button')

	@include('partials._notification')

    <section>
        <div>@include('v2.frontend.dynamo.partials._form')</div>
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