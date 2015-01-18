<?php

// Prepare URL and params to send
$get_url = "/api/v1/dynamo/dyn_prefs";

$data = [
	'user_hash'=>'cb08baf27df3872de174e25ed55e88c1',
	'uid'=>'3'
];

// Call API
$I = new ApiGuy($scenario);
$I->wantTo('Call Get Dynamo Preference API Success');
$I->sendGet($get_url,$data);

// See if response is OK
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();

$success_response = [
	'status'=>(string)1,
];

$I->seeResponseContainsJSON($success_response);
