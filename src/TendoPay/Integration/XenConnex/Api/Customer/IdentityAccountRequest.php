<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Customer\Account\Account;
use TendoPay\Integration\XenConnex\Api\Customer\Constants\IdentityAccountType;
use TendoPay\Integration\XenConnex\Api\ValidationException;

class IdentityAccountRequest extends BaseFilter
{
    public static function builder(): IdentityAccountRequest
    {
        return new IdentityAccountRequest();
    }

    private function __construct()
    {
    }

    /**
     * @throws ValidationException
     */
    public function withType(string $type): IdentityAccountRequest
    {
        $this->addFilter('type', $type)
             ->withAvailableOptions(
                 IdentityAccountType::BANK_ACCOUNT,
                 IdentityAccountType::EWALLET,
                 IdentityAccountType::CREDIT_CARD,
                 IdentityAccountType::PAY_LATER,
                 IdentityAccountType::OTC,
                 IdentityAccountType::QR_CODE);

        return $this;
    }

    public function withCompany(string $company): IdentityAccountRequest
    {
        $this->addFilter('company', $company);

        return $this;
    }

    public function withDescription(string $description): IdentityAccountRequest
    {
        $this->addFilter('description', $description);

        return $this;
    }

    public function withCountry(string $country): IdentityAccountRequest
    {
        $this->addFilter('country', $country);

        return $this;
    }

    public function withProperties(Account $properties): IdentityAccountRequest
    {
        $this->addFilter('properties', $properties->toArray());

        return $this;
    }
}