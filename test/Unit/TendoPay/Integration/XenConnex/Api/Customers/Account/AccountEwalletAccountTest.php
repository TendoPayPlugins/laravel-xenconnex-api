<?php

namespace TendoPay\Integration\XenConnex\Api\Customers\Account;

use PHPUnit\Framework\TestCase;

class AccountEwalletAccountTest extends TestCase
{
    /**
     * @dataProvider validAccounts
     */
    public function testShouldCreateAccount(
        ?string $accountNumber,
        ?string $accountHolderName,
        ?string $currency
    ) {
        $builder = AccountEwalletAccount::builder();
        if ($accountNumber !== null) {
            $builder = $builder->withAccountNumber($accountNumber);
        }
        if ($accountHolderName !== null) {
            $builder = $builder->withAccountHolderName($accountHolderName);
        }
        if ($currency !== null) {
            $builder = $builder->withCurrency($currency);
        }

        $result = $builder->toArray();
        if ($accountNumber !== null) {
            self::assertEquals($accountNumber, $result['account_number']);
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
