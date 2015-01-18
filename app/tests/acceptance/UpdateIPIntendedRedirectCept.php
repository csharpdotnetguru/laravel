<?php
$I = new WebGuy($scenario);
$I->wantTo('Test intended redirection for update ip address link');
$I->amOnPage('/');
$I->click('#auto_update_ip');
$I->seeInCurrentUrl('login');

$I->fillField('email', 'darth.vader@unotelly.com');
$I->fillField('password', 'test123');
$I->click("login_submit");
$I->see('updated','div.content-main-display > div.alert');