@extends('layout.v2.home')

@section('stylesheets')

	<!-- Grid-Page-Common-CSS -->
	@include('v2.frontend.partials._grid-page-common-css')
	<!-- End of Grid-page-common-css -->


@stop

@section('content')

<style>
body {
  background: url( "{{ asset("assets/v2/images/background/wc1.jpg") }}" );
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; 
}

div.wc-title-block {
	background: #e74c3c url('{{ asset("assets/v2/images/icons/Soccer-128.png") }}') left no-repeat;
	height: 50px;
	background-size: 100px;
}

.font-white {
	color: #fff;
	padding-top: 10px;

}

.wc-setup-steps {
	background-color: #ecf0f1;
	padding-top: 30px;
	padding-bottom: 30px;
}


</style>



	
<div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default signin-form">
                    <div class="panel-heading">

                        <h1 class="header">Free World Cup 2014 UnoTelly <small>40-day Extended Access</small></h1>
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
                                {{ Form::text('email', null, ['placeholder' => 'Please enter your e-mail', 'class' => 'form-control', 'id' => 'email', 'required']) }}
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

                        <input type='hidden' name='special_promo' value='true' />

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

</div>	


@section('scripts')

	
@stop



@stop