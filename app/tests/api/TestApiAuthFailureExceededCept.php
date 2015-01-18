<?php

$post_url = '/api/v1/session/authenticate';
$test_params = Config::get('app.test_params');

$data = [
	'email' => '1235@gmail.com',
	'password' => 'test123'
];

$I = new ApiGuy($scenario);
$I->wantTo('Test Fail API login exceeded');
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => 0,
	'message' => 'Login limit exceeded. Please try again.'
];

$I->seeResponseContainsJson($success_response);


$ip = '127.0.0.1';
$rate_limit = App::make('RateLimitRepositoryInterface');
$rate_limit->api_login_faliure_clear($ip);
