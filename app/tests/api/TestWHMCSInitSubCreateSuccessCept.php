<?php

$post_url = '/api/v1/whmcs/init_sub';
$test_params = Config::get('app.test_params');

$data = [
	'uid' => rand(9999999,99999999),
	'pkg_uniq_id' => $test_params['pkg_uniq_id'],
	'product_id' => $test_params['product_id'],
	'api_key' => 'test123'
];

$I = new ApiGuy($scenario);
$I->wantTo('Test WHMCS Init sub created Success');
$I->sendPOST($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => 1,
	'data' => [
		'message' => 'Subscription created.'
	]
];

$I->seeResponseContainsJson($success_response);
