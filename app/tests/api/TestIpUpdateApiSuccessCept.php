<?php

$post_url = '/api/v1/network/update';
$test_params = Config::get('app.test_params');

$data = [
	'user_hash' => $test_params['user_hash'],
	'uid' => $test_params['uid'],
	'country_id' => $test_params['country_id'],
	'channel_id' => $test_params['channel_id']
];

$I = new ApiGuy($scenario);
$I->wantTo('Test IP Update API');
$I->sendGET($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'user_id' => (int) $test_params['uid'],
	'user_hash' => (string) $test_params['user_hash'],
	'status' => 1,
	'msg' => 'IP updated'
];

$I->seeResponseContainsJson($success_response);
