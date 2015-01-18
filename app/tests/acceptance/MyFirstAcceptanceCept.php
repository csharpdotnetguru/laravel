<?php 
$I = new WebGuy($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('login');
$I->fillField('email', 'roger2@dad.com');
$I->fillField('password', 'ak472012');
$I->click("login_submit");
$I->see('roger2@dad.com');

$I->amOnPage('/');

//Check AutoUpdate IP
$I->click('#auto_update_ip');
$I->wait(1);
$I->see('updated', 'div.alert.alert-success'); // Removed div.uno_box selector due to multiple instances



//Check Dynamo Seting
$I->click('Change Settings');
$I->see('<h3 style="display:inline-block;">Netflix</h3>');

$I->selectOption('form input[name="4"]', '2');
$I->wait(1);
$I->see('Canada','//*[@id="channel_update"]/div/div[1]/div[2]/span');

$I->selectOption('form input[name="4"]', '20');
$I->wait(1);
$I->see('Finland','//*[@id="channel_update"]/div/div[1]/div[2]/span');

$I->selectOption('form input[name="4"]', '8');
$I->wait(1);
$I->see('Mexico','//*[@id="channel_update"]/div/div[1]/div[2]/span');


//Authorized Network
$I->seeLink("Authorized Networks");
$I->click('Authorized Networks');
$I->wait(1);
$I->see('<h3>Networks</h3>');

//Create Network
$I->fillField('network_name', 'mock_test');
$I->fillField('ip1', '77');
$I->fillField('ip2', '77');
$I->fillField('ip3', '77');
$I->fillField('ip4', '77');
$I->click('add_network');
$I->see('has been successfully created');


$I->click('Sign Out');
$I->see('Sign in','div.size9.content-main-display > h1'); // Removed div.uno_box selector due to multiple instances