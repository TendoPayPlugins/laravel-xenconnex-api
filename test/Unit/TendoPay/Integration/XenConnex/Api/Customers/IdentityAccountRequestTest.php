<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use PHPUnit\Framework\TestCase;
use TendoPay\Integration\XenConnex\Api\Customers\Account\AccountPayLater;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\Gender;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\IdentityAccountType;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class IdentityAccountRequestTest extends TestCase
{
    /**
     * @dataProvider validIdentityAccountRequest
     * @throws ValidationException
     */
    public function testShouldCreateIdentityAccountRequest(
        ?string $type,
        ?string $company,
        ?string $description,
        ?string $country
    ) {
        $properties = AccountPayLater::builder()->withAccountId('123');
        $builder    = IdentityAccountRequest::builder();
        if ($type !== null) {
            $builder->withType($type);
        }
        if ($company !== null) {
            $builder->withCompany($company);
        }
        if ($description !== null) {
            $builder->withDescription($description);
        }
        if ($country !== null) {
            $builder->withCountry($country);
        }
        $builder->withProperties($properties);


        $result = $builder->toArray();

        if ($type !== null) {
            self::assertEquals($type, $result['type']);
        }
        if ($company !== null) {
            self::assertEquals($company, $result['company']);
        }
        if ($description !== null) {
            self::assertEquals($description, $result['description']);
        }
        if ($country !== null) {
            self::assertEquals($country, $result['country']);
        }
        self::assertEquals($properties->toArray(), $result['properties']);

    }

    public function validIdentityAccountRequest(): array
    {
        return [[IdentityAccountType::BANK_ACCOUNT, 'Surname', 'Description', 'England']];
    }
}
