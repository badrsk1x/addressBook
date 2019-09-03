<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Check that AddressBook pages are working');

//Home Page
$I->amOnPage('/');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->see('Home');
$I->seeElement(".homePageBlock");
$I->see('welcome to Address Book', '.homePageBlock');


// AdressBook list page
$I->click('Contacts List');
$I->seeInCurrentUrl('/addressbook');
$I->amOnPage('/addressbook');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->see('Address book');

// Add new contact page
$I->click('Add contact');
$I->seeInCurrentUrl('/addressbook/add');
$I->amOnPage('/addressbook/add');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->see('Add a new contact');


//Edit page
$I->amOnPage('/addressbook');
$I->click('Edit', 'button[name="edit-button"]');
$I->seeInCurrentUrl('/edit');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->see('Edit the contact', 'h1');

//Delete page
$I->amOnPage('/addressbook');
$I->click('Delete', 'button[name="delete-button"]');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->see('The entry was deleted successfully!', '.alert-success');
