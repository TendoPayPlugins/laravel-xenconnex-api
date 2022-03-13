<?php

namespace TendoPay\Integration\XenConnex\Api\Customer\Account;

class AccountPayLater extends Account
{
    private function __construct()
    {
    }

    public function withAccountId(string $accountId): AccountPayLater
    {
        $this->filters['account_id'] = $accountId;

        return $this;
    }

    public function withAccountHolderName(string $accountHolderName): AccountPayLater
    {
        $this->filters['account_holder_name'] = $accountHolderName;

        return $this;
    }

    public function withCurrency(string $currency): AccountPayLater
    {
        $this->filters['currency'] = $currency;

        return $this;
    }
}