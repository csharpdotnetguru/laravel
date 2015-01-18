@extends('layout.v2.home')

@section('title', ' | My Account')

@section('content')

<div class="container main-content my-account">
    @include('v2.frontend.partials._back-button')

    <section>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 page-title page-header">
                <h1>Edit Profile</h1>
            </div>

            <div class="col-sm-8 col-sm-offset-2 page-content">
                @include('partials._notification')

                {{ Form::model($user, array('route' => 'my_account_update', 'method' => 'PUT')) }}

                <div class="col-xs-6">
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="firstname">First Name</label>

                            <div class="controls">
                                {{ Form::text('firstname', null, array('class' => 'required','id'=>'firstname')) }}
                                <p class="help-block">Enter your first name</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="lastname">Last Name</label>

                            <div class="controls">
                                <!--<input type="text" name='lastname' class="required" id="lastname" >-->
                                {{ Form::text('lastname', null, array('class' => 'required','id'=>'lastname')) }}
                                <p class="help-block">Enter your last name</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="email">E-mail</label>

                            <div class="controls">
                                {{ Form::text('email', null, array('class' => 'required email','id'=>'email','readonly'=>'readonly')) }}
                                <p class="help-block">Enter your e-mail address</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="address1">Billing Address</label>

                            <div class="controls">
                                {{ Form::text('address1', null, array('class' => 'required','id'=>'address1')) }}
                                <p class="help-block">Enter your billing address</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input01">Country</label>

                            <div class="controls">
                                {{ Form::select('country', Utils::getCountries(), null, array('class' => 'required','id'=>'location_country')) }}
                                <p class="help-block">Enter your billing country</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="state">Province/State</label>

                            <div class="controls">

                                <div id="state-div">
                                    {{ Form::text('state', null, array('class' => 'required','id'=>'state')) }}
                                </div>

                                <p class="help-block">Enter your State/Province</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="city">City</label>

                            <div class="controls">
                                {{ Form::text('city', null, array('class' => 'required','id'=>'city')) }}
                                <p class="help-block">Enter your billing city</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="postcode">Zip/Postal Code</label>

                            <div class="controls">
                                {{ Form::text('postcode', null, array('class' => 'required','id'=>'postcode')) }}
                                <p class="help-block">Enter your zip/postal code</p>
                            </div>
                        </div>
                    </fieldset>
                </div>


                <div class="col-xs-6">
                    <fieldset>
                        <h4>Change Password</h4>

                        <p class="help-block">Leave the fields blank if no change is required</p>
                        <br/>

                        <div class="control-group" id="password">
                            <label class="control-label" for="password">Old Password:</label>

                            <div class="controls">
                                {{ Form::password('password', array('class' => 'required','id'=>'password')) }}
                                <p class="help-block">Your Current UnoTelly password.</p>
                            </div>
                        </div>

                        <div class="control-group" id="new_password">
                            <label class="control-label" for="new_password">New Password:</label>

                            <div class="controls">
                                {{ Form::password('new_password', array('class' => 'required','id'=>'new_password')) }}
                                <p class="help-block">Your New UnoTelly password.</p>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary">Save</button>

                    <a class="btn btn-link" href="{{ URL::route('my_account_index') }}">Cancel</a>
                </div>

                {{ Form::close() }}
            </div>
    </section>
</div>

@include('v2.frontend.partials._footer')

@stop