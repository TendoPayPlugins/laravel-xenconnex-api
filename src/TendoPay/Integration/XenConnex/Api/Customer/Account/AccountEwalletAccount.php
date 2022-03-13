<?php

namespace TendoPay\Integration\XenConnex\Api\Customer\Account;

class AccountEwalletAccount extends Account
{
    public static function builder(): AccountEwalletAccount
    {
        return new AccountEwalletAccount();
    }

    private function __construct()
    {
    }

    public function withAccountNumber(string $accountNumber): AccountEwalletAccount
    {
        $this->addFilter('account_number', $accountNumber);

        return $this;
    }

    public function withAccountHolderName(string $accountHolderName): AccountEwalletAccount
    {
        $this->addFilter('account_holder_name', $accountHolderName);

        return $this;
    }

    public function withCurrency(string $currency): AccountEwalletAccount
    {
        $this->addFilter('currency', $currency);

        return $this;
    }
}