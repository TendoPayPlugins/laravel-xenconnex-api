<?php

namespace TendoPay\Integration\XenConnex\Api\Customers\Account;

class AccountOTC extends Account
{
    public static function builder(): AccountOTC
    {
        return new AccountOTC();
    }

    private function __construct()
    {
    }

    public function withPaymentCode(string $paymentCode): AccountOTC
    {
        $this->addFilter('payment_code', $paymentCode);

        return $this;
    }

    public function withExpiresAt(string $expiresAt): AccountOTC
    {
        $this->addFilter('expires_at', $expiresAt);

        return $this;
    }
}