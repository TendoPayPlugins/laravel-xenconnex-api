<?php

namespace TendoPay\Integration\XenConnex\Api\Customers\Account;

class AccountCard extends Account
{
    public static function builder(): AccountCard
    {
        return new AccountCard();
    }

    private function __construct()
    {
    }

    public function withTokenId(string $tokenId): AccountCard
    {
        $this->addFilter('token_id', $tokenId);

        return $this;
    }
}