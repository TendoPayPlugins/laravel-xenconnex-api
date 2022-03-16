<?php

namespace TendoPay\Integration\XenConnex\Api\Customers\Account;

use PHPUnit\Framework\TestCase;

class AccountPayLaterTest extends TestCase
{
    /**
     * @dataProvider validAccounts
     */
    public function testShouldCreateAccount(
        ?string $accountId,
        ?string $accountHolderName,
        ?string $currency
    ) {
        $builder = AccountPayLater::builder();
        if ($accountId !== null) {
            $builder = $builder->withAccountId($accountId);
        }
        if ($accountHolderName !== null) {
            $builder = $builder->withAccountHolderName($accountHolderName);
        }
        if ($currency !== null) {
            $builder = $builder->withCurrency($currency);
        }

        $result = $builder->toArray();
        if ($accountId !== null) {
            self::assertEquals($accountId, $result['account_id']);
        }
        if ($accountHolderName !== null) {
            self::assertEquals($accountHolderName, $result['account_holder_name']);
        }
        if ($currency !== null) {
            self::assertEquals($currency, $result['currency']);
        }
    }


    public function validAccounts(): array
    {
        return [
            ['123434353456', 'name', 'USD'],
            [null, 'name', 'USD'],
            ['123434353456', null, 'USD'],
            ['123434353456', 'name', null]
        ];
    }
}
