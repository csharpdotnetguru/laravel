<?php

$post_url = '/api/v1/dynamo/js_mobile_channels';
$test_params = Config::get('app.test_params');

$data = [
	'email' => '',
	'password' => ''
];

$I = new ApiGuy($scenario);
$I->wantTo('Test API blocked due to excessive requests');

$i = 0;

while($i < 130) {
	$I->sendGET($post_url, $data); //need complete url or will say arrage merge error
	$i++;
}
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$success_response = [
	'status' => 0,
	'message' => 'API Rate Limit Exceeded.'
];

$I->seeResponseContainsJson($success_response);

$ip = $test_params['my_ip'];

$rate_limit = app::make('RateLimitRepositoryInterface');

//clear block after test
$result = $rate_limit->api_public_block_clear($ip, 'api/v1/dynamo/js_mobile_channels');

