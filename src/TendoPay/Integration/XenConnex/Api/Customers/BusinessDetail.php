<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\BusinessType;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class BusinessDetail extends BaseFilter
{
    /**
     * @throws ValidationException
     */
    public static function builder(string $businessName, string $businessType): BusinessDetail
    {
        return new BusinessDetail($businessName, $businessType);
    }

    /**
     * @throws ValidationException
     */
    private function __construct(string $businessName, string $businessType)
    {
        $this->addFilter('business_name', $businessName)->withMaxLength(255);
        $this->addFilter('business_type', $businessType)
             ->withAvailableOptions(
                 BusinessType::CORPORATION,
                 BusinessType::SOLE_PROPRIETOR,
                 BusinessType::PARTNERSHIP,
                 BusinessType::COOPERATIVE,
                 BusinessType::TRUST,
                 BusinessType::NON_PROFIT,
                 BusinessType::GOVERNMENT);
    }

    /**
     * @throws ValidationException
     */
    public function withDateOfRegistration(string $dateOfRegistration): BusinessDetail
    {
        $this->addFilter('date_of_registration', $dateOfRegistration)->withMaxLength(10);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withNatureOfBusiness(string $natureOfBusiness): BusinessDetail
    {
        $this->addFilter('nature_of_business', $natureOfBusiness)->withMaxLength(255);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withBusinessDomicile(string $businessDomicile): BusinessDetail
    {
        $this->addFilter('business_domicile', $businessDomicile)->withMaxLength(2);

        return $this;
    }
}