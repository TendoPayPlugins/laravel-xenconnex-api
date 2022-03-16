<?php

namespace TendoPay\Integration\XenConnex\Api\Customers\Account;

use PHPUnit\Framework\TestCase;

class AccountCartTest extends TestCase
{
    public function testShouldCreateAccount()
    {
        $result = AccountCard::builder()->withTokenId('THETOKENID')->toArray();
        self::assertEquals('THETOKENID', $result['token_id']);
    }
}
