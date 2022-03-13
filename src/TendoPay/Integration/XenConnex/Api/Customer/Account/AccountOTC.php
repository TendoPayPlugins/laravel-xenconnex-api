<?php

namespace TendoPay\Integration\XenConnex\Api\Customer\Account;

class AccountOTC extends Account
{
    private function __construct()
    {
    }

    public function withPaymentCode(string $paymentCode): AccountOTC
    {
        $this->filters['payment_code'] = $paymentCode;

        return $this;
    }

    public function withExpiresAt(string $expiresAt): AccountOTC
    {
        $this->filters['expires_at'] = $expiresAt;

        return $this;
    }
}