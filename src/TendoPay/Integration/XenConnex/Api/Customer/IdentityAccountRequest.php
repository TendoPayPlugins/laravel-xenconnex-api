<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Customer\Account\Account;

class IdentityAccountRequest extends BaseFilter
{
    public static function builder(): IdentityAccountRequest
    {
        return new IdentityAccountRequest();
    }

    private function __construct()
    {
    }

    public function withType(string $type): IdentityAccountRequest
    {
        $this->filters['type'] = $type;

        return $this;
    }

    public function withCompany(string $company): IdentityAccountRequest
    {
        $this->filters['company'] = $company;

        return $this;
    }

    public function withDescription(string $description): IdentityAccountRequest
    {
        $this->filters['description'] = $description;

        return $this;
    }

    public function withCountry(string $country): IdentityAccountRequest
    {
        $this->filters['country'] = $country;

        return $this;
    }

    public function withProperties(Account $properties): IdentityAccountRequest
    {
        $this->filters['properties'] = $properties->toArray();

        return $this;
    }
}