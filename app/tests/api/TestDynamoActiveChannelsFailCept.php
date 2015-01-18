<?php

// Prepare posting url and data
$get_url = "/api/v1/dynamo/active_channels";

$data = [
	'user_hash'=>'somebaduserhash'
];

// Send request to API
$I = new ApiGuy($scenario);
$I->wantTo('Call Dynamo active channels API Fail');
$I->sendGet($get_url,$data);

// Check if requirements are met
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();

$success_response = [
	'status'=>0
];

$I->seeResponseContainsJson($success_response);
