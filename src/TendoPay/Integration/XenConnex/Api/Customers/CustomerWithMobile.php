<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

interface CustomerWithMobile
{
    public function withMobileNumber(string $mobileNumber) : Customer;
}