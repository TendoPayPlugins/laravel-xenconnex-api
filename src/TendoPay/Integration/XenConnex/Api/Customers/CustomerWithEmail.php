<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

interface CustomerWithEmail
{
    public function withEmail(string $email): Customer;
}