<?php

$post_url = '/api/v1/sub/account_status';
$test_params = Config::get('app.test_params');

$data = [
	'callback' => '?',
	'type' => 'json'
];

$I = new ApiGuy($scenario);
$I->wantTo('Test Account Status API');
$I->sendGET($post_url, $data); //need complete url or will say arrage merge error
$I->seeResponseCodeIs(200);

$success_response = '?({"known_user":true,"no_sub":false,"expired":false,"sub_suspended":false});';

$I->seeResponseEquals($success_response);

