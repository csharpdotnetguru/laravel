<?php 

//Successful sign up
$I = new WebGuy($scenario);
$I->wantTo('see full user sign up successful');
$I->amOnPage('/checkout/login');

$email = 'codecept.' . rand(0,10000)  . '@unotelly.com';
$I->fillField('email', $email);
$I->click("#checkout_login > fieldset > div.form-actions > button");

$I->see('<h4>New to UnoTelly? Register Below.</h4>');
$I->see($email);
$I->fillField('firstname', 'John');
$I->fillField('lastname', 'Figpucker');
$I->fillField('email', $email);
$I->fillField('address1', 'Mars 1 Street');
$I->selectOption('form select[name=country]', 'Bermuda');
$I->fillField('state', 'Mars');
$I->fillField('city', 'Mars City');
$I->fillField('postcode', '12345');
$I->fillField('password', 'test123');
$I->click("#sign_up_submit");


$I->see('Your shopping cart');




