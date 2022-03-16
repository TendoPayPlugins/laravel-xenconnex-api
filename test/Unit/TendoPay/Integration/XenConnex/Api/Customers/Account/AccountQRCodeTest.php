<?php

namespace TendoPay\Integration\XenConnex\Api\Customers\Account;

use PHPUnit\Framework\TestCase;

class AccountQRCodeTest extends TestCase
{
    public function testShouldCreateAccount()
    {
        $result = AccountQRCode::builder()->withQrString('SSF454T55')->toArray();
        self::assertEquals('SSF454T55', $result['qr_string']);
    }
}
