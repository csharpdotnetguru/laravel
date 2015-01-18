<?php
$I = new WebGuy($scenario);
/*$I->wantTo('perform actions and see result');*/
$I->goToUrl('http://www.unotelly.com/unodns/pricing');
$I->see('100% Satisfaction Guarantee!');
$I->click('//*[@id="bootstrap_pricing"]/table[1]/thead[2]/tr[1]/th[3]/a[2]');
$I->see('Gold');

$I->goToUrl('https://www.unotelly.com/portal/cart.php?gid=5');
$I->clickByXpath('//*[@id="product0"]/form/div/input');
$I->see('Enter your e-mail address');

$I->fillField('email', 'roger2@dad.com');


$I->selectOption('//*[@id="optionsRadios2"]', 'signin');
$I->waitForElementVisible('#password', 60);
$I->fillField('password', 'ak472012');

$I->click("#checkout_login > fieldset > div.form-actions > button");
$I->see('Your shopping cart');
$I->see('Grand Total: $8.35 USD');
