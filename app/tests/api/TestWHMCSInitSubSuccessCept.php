<?php

$post_url = '/api/v1/whmcs/init_sub';
$test_params = Config::get('app.test_params');

$data = [
	'uid' => $test_params['uid'],
	'pkg_uniq_id' => $test_params['pkg_uniq_id'],
	'product_id' => $test_params['product_id'],
	'api_key' => 'test123'
];

$I = new ApiGuy($scenario);
$I->wantTo('Test WHMCS Init sub update Success');
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => 1,
	'data' => [
		'message' => 'Subscription updated.'
	]
];

$I->seeResponseContainsJson($success_response);
