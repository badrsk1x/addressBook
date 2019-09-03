<?php
namespace Tests\Functional;

use App\Entity\Address;
use Codeception\Util\HttpCode;

class AddressCrudCest
{
    private $adressId;

    /**
     *
     */
    public function viewAddressInFrontend()
    {
        $I->amOnLocalizedPage('/address'. sq('address'));
        $I->see('Test Post'. sq('post'));
        $I->see('Lorem Ipsum dolor');
    }
}
