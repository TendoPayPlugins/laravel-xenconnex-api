<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use PHPUnit\Framework\TestCase;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class AddressRequestTest extends TestCase
{
    /**
     * @dataProvider validAddressRequests
     * @throws ValidationException
     */
    public function testShouldCreateAddressRequest(
        string $country,
        ?string $category,
        ?string $provinceState,
        ?string $city,
        ?string $postalCode,
        ?string $streetLine1,
        ?string $streetLine2,
        ?bool $isPrimary
    ) {
        $builder = AddressRequest::builder($country);
        if ($category !== null) {
            $builder = $builder->withCategory($category);
        }
        if ($provinceState !== null) {
            $builder = $builder->withProvinceState($provinceState);
        }
        if ($city !== null) {
            $builder = $builder->withCity($city);
        }
        if ($postalCode !== null) {
            $builder = $builder->withPostalCode($postalCode);
        }
        if ($streetLine1 !== null) {
            $builder = $builder->withStreetLine1($streetLine1);
        }
        if ($streetLine2 !== null) {
            $builder = $builder->withStreetLine2($streetLine2);
        }
        if ($isPrimary !== null) {
            $builder = $builder->withIsPrimary($isPrimary);
        }

        $result = $builder->toArray();
        self::assertEquals($country, $result['country']);
        if ($category !== null) {
            self::assertEquals($category, $result['category']);
        }
        if ($provinceState !== null) {
            self::assertEquals($provinceState, $result['province_state']);
        }
        if ($city !== null) {
            self::assertEquals($city, $result['city']);
        }
        if ($postalCode !== null) {
            self::assertEquals($postalCode, $result['postal_code']);
        }
        if ($streetLine1 !== null) {
            self::assertEquals($streetLine1, $result['street_line1']);
        }
        if ($streetLine2 !== null) {
            self::assertEquals($streetLine2, $result['street_line2']);
        }
        if ($isPrimary !== null) {
            self::assertEquals($isPrimary, $result['is_primary']);
        }
    }

    /**
     * @dataProvider invalidAddressRequests
     * @throws ValidationException
     */
    public function testShouldNotCreateAddressRequest(
        string $country,
        ?string $category,
        ?string $provinceState,
        ?string $city,
        ?string $postalCode,
        ?string $streetLine1,
        ?string $streetLine2,
        ?bool $isPrimary
    ) {
        $this->expectException(ValidationException::class);

        $builder = AddressRequest::builder($country);
        if ($category !== null) {
            $builder = $builder->withCategory($category);
        }
        if ($provinceState !== null) {
            $builder = $builder->withProvinceState($provinceState);
        }
        if ($city !== null) {
            $builder = $builder->withCity($city);
        }
        if ($postalCode !== null) {
            $builder = $builder->withPostalCode($postalCode);
        }
        if ($streetLine1 !== null) {
            $builder = $builder->withStreetLine1($streetLine1);
        }
        if ($streetLine2 !== null) {
            $builder = $builder->withStreetLine2($streetLine2);
        }
        if ($isPrimary !== null) {
            $builder->withIsPrimary($isPrimary);
        }
    }

    public function validAddressRequests(): array
    {
        return [
            ['EN', 'Category', 'State', 'City', '12345', 'Street 2', 'Street 2', true],
            ['DK', null, 'State', 'City', '12345', 'Street 2', 'Street 2', true],
            ['PL', 'Category', null, 'City', '12345', 'Street 2', 'Street 2', true],
        ];
    }

    public function invalidAddressRequests(): array
    {
        return [
            ['ENG', 'Category', 'State', 'City', '12345', 'Street 2', 'Street 2', true],
            ['POLAND', null, 'State', 'City', '12345', 'Street 2', 'Street 2', true]
        ];
    }
}
