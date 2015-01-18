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

                <h1 class="header">Are you a human?</h1>
            </div>
            <div class="panel-body signin-form">

                @include('partials._notification')

                {{Form::open(array('route'=>'solve_cc_recaptcha','method'=>'post','class'=>'form-horizontal'))}}


                <?php
                require_once(app_path().'/libs/recaptchalib.php');

                $publickey = Config::get('app.recaptcha_public_key');
                echo recaptcha_get_html($publickey,null,true);

                ?>

                <div class="form-group last">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-custom btn-red btn-signin-form">
                            Continue to update credit card
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