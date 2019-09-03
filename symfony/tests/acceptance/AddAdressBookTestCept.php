<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a new contact');
$I->amOnPage('/addressbook/add');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->see('Add a new contact');

// Form fields
$I->fillField('address_book[firstname]', 'John');
$I->fillField('address_book[lastname]', 'Lennon');
$I->fillField('address_book[streetAndNumber]', 'led zeppelin str. 1968');
$I->fillField('address_book[zip]', '56273');
$I->fillField('address_book[city]', 'London');
$I->selectOption('address_book[country]', 'GB');
$I->fillField('address_book[phonenumber]', '+49876111111');
$I->fillField('address_book[birthday]', '1968-01-01');
$I->fillField('address_book[email]', 'enjoy@ledzeppelin.com');

$I->click('Save');
$I->see('The new entry was added!', '.alert-success');
