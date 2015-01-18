<?php

// Prepare URL and params
$get_url = '/api/v1/dynamo/update';

$data = [
	'user_hash'=>'some_bad_user_hash',
	'uid'=>3,
	'channel_id'=>1,
	'country_id'=>1

];

// Call API
$I = new ApiGuy($scenario);
$I->wantTo('Update Dynamo Preferences API Fail');
$I->sendGet($get_url,$data);

// Check response
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();
$I->seeResponseContainsJSON([
		'status'=>0,
		'msg'=>'Wrong user hash key'
	]);