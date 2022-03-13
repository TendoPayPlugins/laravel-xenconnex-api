<?php

namespace TendoPay\Integration\XenConnex\Api\Customer\Account;

class AccountQRCode extends Account
{
    private function __construct()
    {
    }

    public function withQrString(string $qrString): AccountQRCode
    {
        $this->filters['qr_string'] = $qrString;

        return $this;
    }
}