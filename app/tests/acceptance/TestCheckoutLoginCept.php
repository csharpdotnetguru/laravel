<?php
$I = new WebGuy($scenario);
$I->wantTo('test checkout login');
$I->amOnPage('/checkout/login');
$I->fillField('email', 'roger2@dad.com');


$I->selectOption('//*[@id="optionsRadios2"]', 'signin');
$I->waitForElementVisible('#password', 60);
$I->fillField('password', 'wrongpw');

$I->click("#checkout_login > fieldset > div.form-actions > button");
$I->see('Wrong Email and Password. Please try again');



$I->amOnPage('/checkout/login');
$I->fillField('email', 'roger2@dad.com');


$I->selectOption('//*[@id="optionsRadios2"]', 'signin');
$I->waitForElementVisible('#password', 60);
$I->fillField('password', 'ak472012');

$I->click("#checkout_login > fieldset > div.form-actions > button");
$I->see('Your shopping cart');
