<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

use TendoPay\Integration\XenConnex\Api\BaseFilter;

class BusinessDetail extends BaseFilter
{
    public static function builder(string $businessName, string $businessType): BusinessDetail
    {
        return new BusinessDetail(
            [
                'business_name' => $businessName,
                'business_type' => $businessType
            ]);
    }

    private function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function withDateOfRegistration(string $dateOfRegistration)
    {
        $this->filters['date_of_registration'] = $dateOfRegistration;
    }

    public function withNatureOfBusiness(string $natureOfBusiness)
    {
        $this->filters['nature_of_business'] = $natureOfBusiness;
    }

    public function withBusinessDomicile(string $businessDomicile)
    {
        $this->filters['business_domicile'] = $businessDomicile;
    }
}