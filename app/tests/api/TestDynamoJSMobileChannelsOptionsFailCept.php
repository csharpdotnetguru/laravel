<?php

//Prepare URL and data
$get_url = "/api/v1/dynamo/js_mobile_channels_options";
$data = [
	'user_hash'=>'wrong_user_hash'
];

// Call API
$I = new ApiGuy($scenario);
$I->wantTo('Call JS Mobile Channels Options API Fail');
$I->sendGet($get_url,$data);

// Check response
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();
$I->seeResponseContainsJSON([
		'status'=>0,
		'msg'=>'Wrong user hash key'
	]);