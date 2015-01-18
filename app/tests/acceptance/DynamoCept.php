<?php 
$I = new WebGuy($scenario);
$I->wantTo('see if dynamo page loads');
$I->amOnPage('login');
$I->fillField('email', 'roger2@dad.com');
$I->fillField('password', 'ak472012');
$I->click("login_submit");
$I->see('roger2@dad.com');

//Dynamo
$I->seeLink("Change Settings");
$I->click('Change Settings');
$I->see('<h3 style="display:inline-block;">Netflix</h3>');
$I->see('united kingdom');
$I->see('canada');
$I->see('finland');
$I->see('brazil');
