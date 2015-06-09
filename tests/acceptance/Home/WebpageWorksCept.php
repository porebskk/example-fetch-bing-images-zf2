<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('see that the frontpage works');

$I->amOnPage('/');
$I->see('Example');
