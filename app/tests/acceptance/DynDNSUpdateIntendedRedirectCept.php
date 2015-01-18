<?php
$I = new WebGuy($scenario);
$I->wantTo('Test intended redirection for DynDNS update link');
$I->amOnPage('/');
$I->click('DynDNS Update');
$I->seeInCurrentUrl('login');

$I->fillField('email', 'darth.vader@unotelly.com');
$I->fillField('password', 'test123');
$I->click("login_submit");
$I->see('<h3>DynDNS</h3>');