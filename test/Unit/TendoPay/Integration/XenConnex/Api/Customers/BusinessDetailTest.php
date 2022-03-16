<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use PHPUnit\Framework\TestCase;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\BusinessType;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;
use function PHPUnit\Framework\assertEquals;

class BusinessDetailTest extends TestCase
{
    /**
     * @dataProvider validBusinessDetails
     * @throws ValidationException
     */
    public function testShouldCreateBusinessDetail(
        string $businessName,
        string $businessType,
        ?string $businessDomicile,
        ?string $dateOfRegistration,
        ?string $natureOfBusiness
    ) {
        $builder = BusinessDetail::builder($businessName, $businessType);
        if ($businessDomicile !== null) {
            $builder->withBusinessDomicile($businessDomicile);
        }
        if ($dateOfRegistration !== null) {
            $builder->withDateOfRegistration($dateOfRegistration);
        }
        if ($natureOfBusiness !== null) {
            $builder->withNatureOfBusiness($natureOfBusiness);
        }

        $result = $builder->toArray();
        if ($businessDomicile !== null) {
            assertEquals($businessDomicile, $result['business_domicile']);
        }
        if ($dateOfRegistration !== null) {
            assertEquals($dateOfRegistration, $result['date_of_registration']);
        }
        if ($natureOfBusiness !== null) {
            assertEquals($natureOfBusiness, $result['nature_of_business']);
        }
    }

    public function validBusinessDetails(): array
    {
        return [['name', BusinessType::CORPORATION, 'AA', '0123456789', 'nature']];
    }

}
