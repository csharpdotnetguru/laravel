@extends('layout.v2.home')

@section('stylesheets')
{{ HTML::style('assets/v2/css/sign_in.css') }}
@stop

@section('title', ' | Sign In')

@section('content')

<div id="full_page_container">

    <div class="container signin-form">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default signin-form">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-lock signin-form"></span>

                        <h1 class="signin">Sign In</h1>
                    </div>
                    <div class="panel-body signin-form">

                        @include('partials._notification')

                        {{Form::open(array('route'=>'session_authenticate','method'=>'post','class'=>'form-horizontal'))}}

                        <div class="form-group signin-form">
                            <label for="inputEmail" class="col-sm-3 control-label">
                                <h2 class="signin">Email</h2>
                            </label>

                            <div class="col-sm-9 signin-input-container">
                                {{ Form::text('email', null, ['placeholder' => 'Please enter your e-mail', 'class' => 'form-control', 'id' => 'inputEmail', 'required']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-3 control-label">
                                <h2 class="signin">Password</h2>
                            </label>

                            <div class="col-sm-9 signin-input-container">
                                {{ Form::password('password', ['placeholder' => 'Please enter your password', 'class' => 'form-control', 'id' => 'inputPassword', 'required']) }}
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
                                    Sign in
                                </button>

                            </div>
                        </div>

                        {{Form::close();}}

                    </div>
                    <div class="panel-footer signin-form">
                        <p class="small">Forgot your password?
                            <a href="https://www.unotelly.com/portal/pwreset.php">Reset Password</p></a></div>
                </div>
            </div>
        </div>
    </div>

    @include('v2.frontend.partials._footer')

</div>

@stop

@section('scripts')
<script>
    $(function() {
        $('#inputEmail').focus();
    });
</script>
@stop