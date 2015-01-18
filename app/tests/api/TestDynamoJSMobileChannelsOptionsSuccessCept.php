<?php

//Prepare URL and data
$get_url = "/api/v1/dynamo/js_mobile_channels_options";
$data = [
	'user_hash'=>'cb08baf27df3872de174e25ed55e88c1'
];

// Call API
$I = new ApiGuy($scenario);
$I->wantTo('Call JS Mobile Channels Options API Success');
$I->sendGet($get_url,$data);

// Check response
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();
$I->seeResponseContainsJSON([
		'status'=>(string)1,
	]);