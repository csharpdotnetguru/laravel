<?php

$post_url = '/api/v1/whmcs/find_pw_hash';
$test_params = Config::get('app.test_params');

$data = [
	'uid' => $test_params['uid'],
	'api_key' => Config::get('app.api_key')
];

$I = new ApiGuy($scenario);
$I->wantTo('Test success WHMCS Find PW Hash API');
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => 1,
	'data' => [
		'pw_hash' => $test_params['password_hash'],
		'msg' => 'Password Hash Found.'
	]

];

$I->seeResponseContainsJson($success_response);
