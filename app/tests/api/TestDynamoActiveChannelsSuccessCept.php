<?php

// Prepare posting url and data
$get_url = "/api/v1/dynamo/active_channels";
$test_params = Config::get('app.test_params');

$data = [
	'user_hash'=>$test_params['user_hash']
];

// Send request to API
$I = new ApiGuy($scenario);
$I->wantTo('Call Dynamo active channels API Success');
$I->sendGet($get_url,$data);

// Check if requirements are met
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();

$success_response = [
	'status'=>(string)1
];

$I->seeResponseContainsJson($success_response);
