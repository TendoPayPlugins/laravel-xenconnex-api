<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use PHPUnit\Framework\TestCase;

class EmploymentDetailTest extends TestCase
{
    /**
     * @dataProvider validIdentityAccountRequest
     * =     */
    public function testShouldCreateIdentityAccountRequest(
        ?string $employerName,
        ?string $natureOfBusiness,
        ?string $roleDescription
    ) {
        $builder = EmploymentDetail::builder();
        if ($employerName !== null) {
            $builder->withEmployerName($employerName);
        }
        if ($natureOfBusiness !== null) {
            $builder->withNatureOfBusiness($natureOfBusiness);
        }
        if ($roleDescription !== null) {
            $builder->withRoleDescription($roleDescription);
        }

        $result = $builder->toArray();

        if ($employerName !== null) {
            self::assertEquals($employerName, $result['employer_name']);
        }
        if ($natureOfBusiness !== null) {
            self::assertEquals($natureOfBusiness, $result['nature_of_business']);
        }
        if ($roleDescription !== null) {
            self::assertEquals($roleDescription, $result['role_description']);
        }
    }

    public function validIdentityAccountRequest(): array
    {
        return [
            ['Name', 'Nature', 'The Role'],
            ['Name', 'Nature', null]
        ];
    }
}
