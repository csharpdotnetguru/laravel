<?php


$I = new WebGuy($scenario);
$I->wantTo('Test fail login');
$I->amOnPage('login');
$I->fillField('email', 'roger2xxxxxx@dad.com');
$I->fillField('password', 'xxxxxxx');
$I->click("login_submit");
$I->see('Wrong Email and Password. Please try again');
$ip = Request::server('REMOTE_ADDR');
$rate_limit_interface = app::make('RateLimitRepositoryInterface');
$rate_limit_interface->api_login_faliure_clear($ip);
