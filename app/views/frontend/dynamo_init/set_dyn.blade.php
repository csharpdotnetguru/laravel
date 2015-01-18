@extends('layout.v2.home')

@section('stylesheets')
	{{  HTML::style('assets/css/style.css') }}
@stop

@section('content')
		<?php
		$index = 0;
		?>
<div class="container main-content">


@if(isset($step2))
<div class="navbar-inner">
    <div class="">


        <div id="step1">
            <a href="#">
                <b>Step 1:</b> Choose Region Preference <i class="icon-ok"></i>
            </a>
        </div>

        <div id="step2">
            <a href="{{URL::route('choose_system')}}">
                <b>Step 2:</b> Complete UnoDNS Setup <i class="icon-circle-arrow-right"></i>
            </a>
        </div>


        <div id="progressbar" class="progress progress-striped active">
            <div class="bar" style="width: 50%;"></div>
        </div>


        <div id="btncontinue">
            <a href="{{URL::route('choose_system')}}">
                <button class="btn btn-large btn-primary" type="button">Continue to Step 2 <i
                        class="icon-circle-arrow-right icon-white"></i></button>
            </a>
        </div>
    </div>
</div>
@else
<div class="navbar">
    <div class="navbar-inner">
        <div class="">


            <div id="step1">
                <a href="#">
                    <b>Almost there:</b> Select Operating System Type <i class="icon-ok"></i>
                </a>
            </div>

            <div id="step2">

            </div>


            <div id="progressbar" class="progress progress-striped active">
                <div class="bar" style="width: 100%;"></div>
            </div>

            <div id="btnback">
                <a href="{{URL::route('choose_dynamo',Authenticate::get_uid())}}"><button class="btn btn-large btn-primary" type="button"><i class="icon-circle-arrow-left icon-white"></i> Go back </button></a>
            </div>

            <div id="btncontinue">
            </div>


        </div>
    </div>
</div>
@endif
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