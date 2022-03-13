<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

interface CustomerWithMobile
{
    public function withMobileNumber(string $mobileNumber) : Customer;
}