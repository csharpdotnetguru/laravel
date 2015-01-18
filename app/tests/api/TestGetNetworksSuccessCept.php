<?php

$post_url = '/api/v1/network/get_networks';
$test_params = Config::get('app.test_params');

$data = [
	'user_hash'=>$test_params['user_hash']
];

$I = new ApiGuy($scenario);
$I->wantTo('test Get Networks by user hash API call');
$I->sendGet($post_url,$data);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => '1',
	//'msg'=>"Fetched all networks."
];

$I->seeResponseContainsJson($success_response);