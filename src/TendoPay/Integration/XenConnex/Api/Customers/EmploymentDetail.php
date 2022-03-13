<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use TendoPay\Integration\XenConnex\Api\BaseFilter;

class EmploymentDetail extends BaseFilter
{
    public static function builder(): EmploymentDetail
    {
        return new EmploymentDetail();
    }

    private function __construct()
    {
    }

    function withEmployerName(string $employerName): EmploymentDetail
    {
        $this->addFilter('employer_name', $employerName);

        return $this;
    }

    public function withNatureOfBusiness(string $natureOfBusiness): EmploymentDetail
    {
        $this->addFilter('nature_of_business', $natureOfBusiness);


        return $this;
    }

    public function withRoleDescription(string $roleDescription): EmploymentDetail
    {
        $this->addFilter('role_description', $roleDescription);

        return $this;
    }
}