<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a edit contact');
$I->amOnPage('/addressbook');
$I->click('Edit', 'button[name="edit-button"]');
$I->seeInCurrentUrl('/edit');

// Form fields
$I->fillField('address_book[firstname]', 'Paul');
$I->fillField('address_book[lastname]', 'McCartney');
$I->fillField('address_book[streetAndNumber]', 'Beatles str. 1960');
$I->fillField('address_book[zip]', '56273');
$I->fillField('address_book[city]', 'London');
$I->selectOption('address_book[country]', 'GB');
$I->fillField('address_book[phonenumber]', '+49876111111');
$I->fillField('address_book[birthday]', '1968-01-01');
$I->fillField('address_book[email]', 'enjoy@ledzeppelin.com');

$I->click('Save');
$I->see('The entry was modified!', '.alert-success');
