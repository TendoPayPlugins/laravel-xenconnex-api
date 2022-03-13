<?php

namespace TendoPay\Integration\XenConnex\Api\Customers\Account;

class AccountQRCode extends Account
{
    public static function builder(): AccountQRCode
    {
        return new AccountQRCode();
    }

    private function __construct()
    {
    }

    public function withQrString(string $qrString): AccountQRCode
    {
        $this->addFilter('qr_string', $qrString);

        return $this;
    }
}