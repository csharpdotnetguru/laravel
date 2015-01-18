<?php

$post_url = '/api/v1/session/authenticate';
$test_params = Config::get('app.test_params');

$data = [
	'email' => '1235@gmail.com',
	'password' => 'test123'
];

$I = new ApiGuy($scenario);
$I->wantTo('Test Fail API login');
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => 0,
	'msg' => 'Wrong e-mail or password'
];

$I->seeResponseContainsJson($success_response);