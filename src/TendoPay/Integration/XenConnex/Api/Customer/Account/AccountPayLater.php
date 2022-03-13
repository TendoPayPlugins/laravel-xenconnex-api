<?php

namespace TendoPay\Integration\XenConnex\Api\Customer\Account;

class AccountPayLater extends Account
{
    public static function builder(): AccountPayLater
    {
        return new AccountPayLater();
    }

    private function __construct()
    {
    }

    public function withAccountId(string $accountId): AccountPayLater
    {
        $this->addFilter('account_id', $accountId);

        return $this;
    }

    public function withAccountHolderName(string $accountHolderName): AccountPayLater
    {
        $this->addFilter('account_holder_name', $accountHolderName);

        return $this;
    }

    public function withCurrency(string $currency): AccountPayLater
    {
        $this->addFilter('currency', $currency);

        return $this;
    }
}