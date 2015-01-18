<?php
$ip = Request::server('REMOTE_ADDR');
$rate_limit_interface = app::make('RateLimitRepositoryInterface');
$rate_limit_interface->api_login_faliure_clear($ip);


$test_params = Config::get('app.test_params_secondary'); // Switched to secondary user

$I = new WebGuy($scenario);
$I->wantTo('Try to update user password with wrong current password');

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
$I->fillField('password','badPass');
$I->fillField('new_password','newPass123');
$I->click("#sign_up_submit");
$I->see('The current password you entered is not correct');

$ip = Request::server('REMOTE_ADDR');
$rate_limit_interface = app::make('RateLimitRepositoryInterface');
$rate_limit_interface->api_login_faliure_clear($ip);
