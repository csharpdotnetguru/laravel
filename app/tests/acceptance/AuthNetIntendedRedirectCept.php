<?php
$I = new WebGuy($scenario);
$I->wantTo('Test intended redirection for authorized networks link');
$I->amOnPage('/');
$I->click('Authorized Networks');
$I->seeInCurrentUrl('login');

$I->fillField('email', 'darth.vader@unotelly.com');
$I->fillField('password', 'test123');
$I->click("login_submit");
$I->see('ip update link');