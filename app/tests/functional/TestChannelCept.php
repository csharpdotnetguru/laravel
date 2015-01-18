<?php
$I = new TestGuy($scenario);
$I->wantTo('test channel page works');
$I->amOnPage('/channels');
$I->see('Total number of');