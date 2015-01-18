<?php

$post_url = '/api/v1/dynamo/js_mobile_channels';
$test_params = Config::get('app.test_params');

$data = [
	'user_hash' => $test_params['user_hash']
];

$I = new ApiGuy($scenario);
$I->wantTo('Test success Dyn Channel API');
$I->sendGET($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => (string) 1
];

$I->seeResponseContainsJson($success_response);
$I->value_not_null_empty('data');