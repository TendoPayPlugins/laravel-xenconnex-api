<?php

namespace TendoPay\Integration\XenConnex\Api\Customers\Account;

use PHPUnit\Framework\TestCase;

class AccountOTCTest extends TestCase
{
    /**
     * @dataProvider validAccounts
     */
    public function testShouldCreateAccount(
        ?string $expiresAt,
        ?string $paymentCode
    ) {
        $builder = AccountOTC::builder();
        if ($expiresAt !== null) {
            $builder = $builder->withExpiresAt($expiresAt);
        }
        if ($paymentCode !== null) {
            $builder = $builder->withPaymentCode($paymentCode);
        }

        $result = $builder->toArray();
        if ($expiresAt !== null) {
            self::assertEquals($expiresAt, $result['expires_at']);
        }
        if ($paymentCode !== null) {
            self::assertEquals($paymentCode, $result['payment_code']);
        }
    }


    public function validAccounts(): array
    {
        return [
            ['2023-12-12', 'PAYCODE'],
            [null, 'PAYCODE'],
            ['2023-12-12', null],
        ];
    }
}
