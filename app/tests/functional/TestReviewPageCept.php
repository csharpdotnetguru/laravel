<?php
$I = new TestGuy($scenario);
$I->wantTo('make sure review page works');
$I->amOnPage('/reviews');
$I->see('UnoDNS - Reviews');