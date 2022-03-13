<?php

namespace TendoPay\Integration\XenConnex\Api\Customer\Account;

class AccountEwalletAccount extends Account
{
    private function __construct()
    {
    }

    public function withAccountNumber(string $accountNumber): AccountEwalletAccount
    {
        $this->filters['account_number'] = $accountNumber;

        return $this;
    }

    public function withAccountHolderName(string $accountHolderName): AccountEwalletAccount
    {
        $this->filters['account_holder_name'] = $accountHolderName;

        return $this;
    }

    public function withCurrency(string $currency): AccountEwalletAccount
    {
        $this->filters['currency'] = $currency;

        return $this;
    }
}