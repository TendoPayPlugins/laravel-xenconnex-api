<?php

namespace TendoPay\Integration\XenConnex\Api\Customers\Account;

use PHPUnit\Framework\TestCase;

class AccountBankAccountTest extends TestCase
{
    /**
     * @dataProvider validAccounts
     */
    public function testShouldCreateAccount(
        ?string $accountNumber,
        ?string $accountHolderName,
        ?string $swiftCode,
        ?string $accountType,
        ?string $accountDetails,
        ?string $currency
    ) {
        $builder = AccountBankAccount::builder();
        if ($accountNumber !== null) {
            $builder = $builder->withAccountNumber($accountNumber);
        }
        if ($accountHolderName !== null) {
            $builder = $builder->withAccountHolderName($accountHolderName);
        }
        if ($swiftCode !== null) {
            $builder = $builder->withSwiftCode($swiftCode);
        }
        if ($accountType !== null) {
            $builder = $builder->withAccountType($accountType);
        }
        if ($accountDetails !== null) {
            $builder = $builder->withAccountDetails($accountDetails);
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
        if ($swiftCode !== null) {
            self::assertEquals($swiftCode, $result['swift_code']);
        }
        if ($accountType !== null) {
            self::assertEquals($accountType, $result['account_type']);
        }
        if ($accountDetails !== null) {
            self::assertEquals($accountDetails, $result['account_details']);
        }
        if ($currency !== null) {
            self::assertEquals($currency, $result['currency']);
        }
    }


    public function validAccounts(): array
    {
        return [
            ['123434353456', 'name', 'BIGBUSPW', 'Savings', 'details', 'USD'],
            [null, 'name', 'BIGBUSPW', 'Savings', 'details', 'USD'],
            ['123434353456', null, 'BIGBUSPW', 'Savings', 'details', 'USD'],
            ['123434353456', 'name', null, 'Savings', 'details', 'USD'],
            ['123434353456', 'name', 'BIGBUSPW', null, 'details', 'USD'],
            ['123434353456', 'name', 'BIGBUSPW', 'Savings', null, 'USD'],
            ['123434353456', 'name', 'BIGBUSPW', 'Savings', 'details', null]
        ];
    }
}
