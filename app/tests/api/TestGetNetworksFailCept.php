<?php

$post_url = '/api/v1/network/get_networks';

$data = [
	'user_hash'=>'somebaduserhash'
];

$I = new ApiGuy($scenario);
$I->wantTo('test Get Networks by user hash API call Fail');
$I->sendGet($post_url,$data);

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();

$success_response = [
	'status' => 0,
	'msg'=>"missing or wrong user hash"
];

$I->seeResponseContainsJson($success_response);