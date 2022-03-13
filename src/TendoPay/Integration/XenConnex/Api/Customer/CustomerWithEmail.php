<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

interface CustomerWithEmail
{
    public function withEmail(string $email): Customer;
}