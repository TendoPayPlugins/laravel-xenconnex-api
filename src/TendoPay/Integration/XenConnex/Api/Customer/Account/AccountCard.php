<?php

namespace TendoPay\Integration\XenConnex\Api\Customer\Account;

class AccountCard extends Account
{
    private function __construct()
    {
    }

    public function withTokenId(string $tokenId): AccountCard
    {
        $this->filters['token_id'] = $tokenId;

        return $this;
    }
}