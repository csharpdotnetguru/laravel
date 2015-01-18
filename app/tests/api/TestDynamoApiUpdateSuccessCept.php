<?php

$post_url = '/api/v1/dynamo/update';
$test_params = Config::get('app.test_params');

$data = [
	'user_hash' => $test_params['user_hash'],
	'uid' => $test_params['uid'],
	'country_id' => $test_params['country_id'],
	'channel_id' => $test_params['channel_id']
];

$I = new ApiGuy($scenario);
$I->wantTo('Test success Dyn Update API');
$I->sendGET($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => (string) 1,
	'msg' => 'Dynamo setting updated.'
];

$I->seeResponseContainsJson($success_response);
