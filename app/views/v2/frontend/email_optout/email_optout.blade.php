@extends('layout.v2.home')

@section('stylesheets')

	<!-- Grid-Page-Common-CSS -->
	@include('v2.frontend.partials._grid-page-common-css')
	<!-- End of Grid-page-common-css -->


@stop

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default signin-form">
            <div class="panel-heading">

                <h1 class="header">Opt-out of UnoTelly E-mail</h1>
            </div>
            <div class="panel-body signin-form">


                @include('partials._notification')

                {{Form::open(array('route'=>'email_optout','method'=>'post','class'=>'form-horizontal'))}}


                <div class="form-group signin-form">
                    <label for="inputEmail" class="col-sm-3 control-label">
                        <h4>E-mail</h4>
                    </label>

                    <div class="col-sm-9 signin-input-container">
                        {{ Form::text('email_optout',  $email_optout , ['placeholder' => 'Please enter your e-mail', 'class' => 'form-control', 'id' => 'email_optout', 'required']) }}
                    </div>

                </div>


                <div class="form-group last">

                    <div class="col-sm-offset-3 col-sm-9">
                                    <p>Opting out will disable your UnoTelly account. Are you sure?</p>

                        <button type="submit" class="btn btn-custom btn-red btn-signin-form">
                            Opt Out
                        </button>

                    </div>
                </div>

                {{Form::close();}}

            </div>

        </div>
    </div>
</div>

@include('v2.frontend.partials._footer')

@section('scripts')


@stop



@stop