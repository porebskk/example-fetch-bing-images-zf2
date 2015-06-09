<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('want to see the remote files getting loaded');

$I->amOnPage('/');
$I->seeNumberOfElements('.thumbnail', 0);
//since we are running with phpbrowser and not a real browser we submit the form manualy
$I->submitForm('form', ['searchTerm' => 'test']);

$I->seeNumberOfElements('.thumbnail', 20);
