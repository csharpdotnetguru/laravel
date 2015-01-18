<?php

$ip = Request::server('REMOTE_ADDR');
$rate_limit_interface = app::make('RateLimitRepositoryInterface');
$rate_limit_interface->api_login_faliure_clear($ip);


$test_params = Config::get('app.test_params_secondary'); //Switched to secondary user

$I = new WebGuy($scenario);
$I->wantTo('Update user password and authenticate with new password');

// Perform Login
$I->amOnPage('login');
$I->fillField('email', $test_params['email']);
$I->fillField('password', $test_params['password']);
$I->click("login_submit");
$I->see('<h3 class="page-header">My Account </h3>');

// Go To Edit Page and check if correct page
$I->click('Update Profile');
$I->see('<h1>Edit Profile</h1>');

// Update password
$I->fillField('password',$test_params['password']);
$I->fillField('new_password','newPass123');
$I->click("#sign_up_submit");
$I->see('User profile updated successfully');

// Sign Out and Sign In with new credentials
$I->amOnPage('/');
$I->click('Sign Out');
$I->see('Sign in'); // Sign Out Successful
$I->fillField('email', $test_params['email']);
$I->fillField('password', 'newPass123');
$I->click("login_submit");
$I->see('<h3 class="page-header">My Account </h3>');


// Revert password for future use
$I->click('Update Profile');
$I->see('<h1>Edit Profile</h1>');
$I->fillField('password','newPass123');
$I->fillField('new_password',$test_params['password']);
$I->click("#sign_up_submit");
$I->see('User profile updated successfully');

