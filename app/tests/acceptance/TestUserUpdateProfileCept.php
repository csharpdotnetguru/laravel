<?php
$test_params = Config::get('app.test_params_secondary'); // Switched to secondary user

$I = new WebGuy($scenario);
$I->wantTo('Update user profile and check results');

// Perform Login
$I->amOnPage('login');
$I->fillField('email', $test_params['email']);
$I->fillField('password', $test_params['password']);
$I->click("login_submit");
$I->see('<h3 class="page-header">My Account </h3>');

// Go To Edit Page and check if correct page
$I->click('Update Profile');
$I->see('<h1>Edit Profile</h1>');

// Make changes to user attributes
$I->fillField('firstname',$test_params['firstname'].rand(0,9999));
$I->fillField('lastname',$test_params['lastname'].rand(0,9999));
$I->click("#sign_up_submit");
$I->see('User profile updated successfully');
