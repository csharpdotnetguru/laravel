<?php

$post_url = '/api/v1/session/authenticate';
$test_params = Config::get('app.test_params');

$data = [
	'email' => $test_params['email'],
	'password' => $test_params['password']
];

$I = new ApiGuy($scenario);
$I->wantTo('Test success API login');
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'uid' => (int) $test_params['uid'],
	'user_hash'=> $test_params['user_hash'],
	'email' => $test_params['email'],
	'status' => 1,
	'msg' => 'Login successful.'
];

$I->seeResponseContainsJson($success_response);