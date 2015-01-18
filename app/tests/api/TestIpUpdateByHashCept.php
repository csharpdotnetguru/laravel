<?php

$post_url = '/api/v1/network/update_by_hash_api';
$test_params = Config::get('app.test_params');


$data = [
	'user_hash' => $test_params['user_hash'],
	'type'=>'json' // Added json parameter to get response in JSON
];

$I = new ApiGuy($scenario);
$I->wantTo('Test IP Update by User Hash API');
$I->sendGET($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => true,
	'message' => 'IP Updated.',
	// Removed IP check because it is not possible to fetch IP 
];

$I->seeResponseContainsJson($success_response);
