<?php
$test_params = Config::get('app.test_params');

// Prepare posting url and data
$get_url = "/api/public/v2/dynamo/dynamo_channels";

$data = [
	'user_hash'=> $test_params['user_hash'],
	'uid'=> $test_params['uid']
];

// Send request to API
$I = new ApiGuy($scenario);
$I->wantTo('Call Dynamo Get all channels success');
$I->sendGet($get_url,$data);

// Check if requirements are met
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();

$success_response = [
	'status'=> 1,
	'message' => 'Success. Returning a list of Dynamo Channels.'
];

$I->seeResponseContainsJson($success_response);
