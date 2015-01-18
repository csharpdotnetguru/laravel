<?php

// Prepare posting URL
$get_url = "/api/v1/unohelper/get_dns_servers";

// Call posting url
$I = new ApiGuy($scenario);
$I->wantTo('Call Get DNS Servers API Success');
$I->sendGet($get_url);

// Check response
$I->seeResponseCodeIs(200);
$I->seeResponseIsJSON();

$success_response = [
	'status'=>1,
	'msg'=>"List of DNS servers"
];

$I->seeResponseContainsJSON($success_response);