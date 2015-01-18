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

                <h1 class="header">Free 8-day UnoTelly Premium Trial <small>No Credit Card Required</small></h1>
            </div>
            <div class="panel-body signin-form">

                @include('partials._notification')

                {{Form::open(array('route'=>'user_store','method'=>'post','class'=>'form-horizontal'))}}


                <div class="form-group signin-form">
                    <label for="inputEmail" class="col-sm-3 control-label">
                        <h4>First Name</h4>
                    </label>

                    <div class="col-sm-9 signin-input-container">
                        {{ Form::text('firstname', null, ['placeholder' => 'Please enter your firstname', 'class' => 'form-control', 'id' => 'firstname', 'required']) }}
                    </div>

                </div>

                <div class="form-group signin-form">

                    <label for="inputEmail" class="col-sm-3 control-label">
                        <h4>Email</h4>
                    </label>

                    <div class="col-sm-9 signin-input-container">
                        {{ Form::text('email', null, ['placeholder' => 'You will be asked to confirm your e-mail before activation', 'class' => 'form-control', 'id' => 'email', 'required']) }}
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputPassword" class="col-sm-3 control-label">
                        <h4>Password</h4>
                    </label>

                    <div class="col-sm-9 signin-input-container">
                        {{ Form::password('password', ['placeholder' => 'Please enter your password', 'class' => 'form-control', 'id' => 'password', 'required']) }}
                    </div>
                </div>

                <!--                     <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"/>
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                    </div> -->

                @if($show_recaptcha === TRUE)
                    <div class="form-group">
                        <label for="recaptcha" class="col-sm-3 control-label">
                            <h4>Are you human?</h4>
                        </label>

                        <div class="col-sm-9 signin-input-container">
                        <?php
                                require_once(app_path().'/libs/recaptchalib.php');
                                $publickey = Config::get('app.recaptcha_public_key');
                                echo recaptcha_get_html($publickey,null,true);
                        ?>
                        </div>
                    </div>
                @endif




                <div class="form-group last">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-custom btn-red btn-signin-form">
                            Sign Up
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