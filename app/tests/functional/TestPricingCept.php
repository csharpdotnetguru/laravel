<?php
$I = new TestGuy($scenario);
$I->wantTo('test pricing page works');
$I->amOnPage('/pricing');
$I->see('Satisfaction Guarantee');