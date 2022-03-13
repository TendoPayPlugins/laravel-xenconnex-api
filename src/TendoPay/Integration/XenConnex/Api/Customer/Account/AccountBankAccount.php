<?php

namespace TendoPay\Integration\XenConnex\Api\Customer\Account;

class AccountBankAccount extends Account
{
    public static function builder(): AccountBankAccount
    {
        return new AccountBankAccount();
    }

    private function __construct()
    {
    }

    public function withAccountNumber(string $accountNumber): AccountBankAccount
    {
        $this->addFilter('account_number', $accountNumber);

        return $this;
    }

    public function withAccountHolderName(string $accountHolderName): AccountBankAccount
    {
        $this->addFilter('account_holder_name', $accountHolderName);

        return $this;
    }

    public function withSwiftCode(string $swiftCode): AccountBankAccount
    {
        $this->addFilter('swift_code', $swiftCode);

        return $this;
    }

    public function withAccountType(string $accountType): AccountBankAccount
    {
        $this->addFilter('account_type', $accountType);

        return $this;
    }

    public function withAccountDetails(string $accountDetails): AccountBankAccount
    {
        $this->addFilter('account_details', $accountDetails);

        return $this;
    }

    public function withCurrency(string $currency): AccountBankAccount
    {
        $this->addFilter('currency', $currency);

        return $this;
    }
}