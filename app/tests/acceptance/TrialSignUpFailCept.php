<?php

//Failed Sign up

$I = new WebGuy($scenario);
$I->wantTo('see trial sign up fail');
$I->amOnPage('/signup');
$I->see('Premium 8-day free trial');
$I->click("#trynow");
$I->waitForElementVisible('#form_container', 60);
$I->fillField('firstname', 'John');
$I->fillField('email', 'roger2@dad.com');
$I->fillField('password', 'ak472012');
$I->click("#signUp");
$I->see('The email has already been taken.');
