<?php

// Prepare URL and params
$get_url = '/api/v1/dynamo/update';

$data = [
	'user_hash'=>'cb08baf27df3872de174e25ed55e88c1',
	'uid'=>3,
	'channel_id'=>1,
	'country_id'=>1

];

// Call API
$I = new ApiGuy($scenario);
$I->wantTo('Update Dynamo Preferences API Success');
$I->sendGet($get_url,$data);

// Check response
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();
$I->seeResponseContainsJSON([
		'status'=>(string)1,
		'msg'=>'Dynamo setting updated.'
	]);