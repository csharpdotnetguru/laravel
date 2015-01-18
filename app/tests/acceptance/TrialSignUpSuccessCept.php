<?php 

//Successful sign up
$I = new WebGuy($scenario);
$I->wantTo('see trial user create successful');
$I->amOnPage('/signup');
$I->see('Premium 8-day free trial');
$I->click("#trynow");
$I->waitForElementVisible('#form_container', 60);

$email = 'codcept.' . rand(0,10000)  . '@unotelly.com';

$I->fillField('firstname', 'John');
$I->fillField('email', $email);
$I->fillField('password', 'test123');
$I->click("#signUp");


//Check Setup Wizard

$I->see('<h2>Dynamo Settings</h2>');

$I->selectOption('form input[name="4"]', '2');
$I->wait(1);
$I->see('Canada','//*[@id="channel_update"]/div/div[1]/div[2]/span');

$I->selectOption('form input[name="4"]', '20');
$I->wait(1);
$I->see('Finland','//*[@id="channel_update"]/div/div[1]/div[2]/span');

$I->selectOption('form input[name="4"]', '8');
$I->wait(1);
$I->see('Mexico','//*[@id="channel_update"]/div/div[1]/div[2]/span');

$I->click('//*[@id="btncontinue"]/a/button');
$I->see('Step 3: Select Operating System Type','/html/body/div[2]/div[2]/div/div/div/div/div[2]/div[1]/div/h2');

$I->click('/html/body/div[2]/div[2]/div/div/div/div/div[2]/div[2]/ul/li[1]/a');
$I->see('Windows XP/Vista/7/8', '//*[@id="folder-show-29878"]/h2');

$I->amOnPage('/');
$I->click('Authorized Network');
$I->see('Default_Network');

