<?php

$post_url = '/api/v1/whmcs/session_code_auth';
$test_params = Config::get('app.test_params');

$data = [
	'uid' => $test_params['uid'],
	'session_code' => $test_params['session_code_success'],
	'api_key' => 'test123'
];

$I = new ApiGuy($scenario);
$I->wantTo('Test WHMCS SessionCode Auth API Success');
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => 1,
	'data' => [
		'uid' => (string) $test_params['uid'],
		'msg' => 'Session code ok.'
	]
];

$I->seeResponseContainsJson($success_response);
