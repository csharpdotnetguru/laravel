<?php
// Prepare URL and posting data
$post_url = "/api/v1/whmcs/create_sub";
$test_params = Config::get('app.test_params');

$params = [
	'uid'=>$test_params['uid'],
	'sub_length'=>10,
	'product_id'=>1,
	'product_type'=>2,
	'api_key' => 'test123'
];

// Call API
$I = new ApiGuy($scenario);
$I->wantTo('create subscription API success');
$I->sendPost($post_url,$params);

// Test Response
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();
$success_response = [
	'status' => 1, 
	'data' => [
		'message' => 'Subscrption created or updated.'
	]
];

$I->seeResponseContainsJSON($success_response);
