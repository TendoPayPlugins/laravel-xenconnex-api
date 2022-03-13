<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

use TendoPay\Integration\XenConnex\Api\BaseFilter;

class AddressRequest extends BaseFilter
{
    public static function builder(string $country): AddressRequest
    {
        return new AddressRequest(['country' => $country]);
    }

    private function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function withCategory(string $category): AddressRequest
    {
        $this->filters['category'] = $category;

        return $this;
    }

    public function withProvinceState(string $provinceState): AddressRequest
    {
        $this->filters['province_state'] = $provinceState;

        return $this;
    }

    public function withCity(string $city): AddressRequest
    {
        $this->filters['city'] = $city;

        return $this;
    }

    public function withPostalCode(string $postalCode): AddressRequest
    {
        $this->filters['postal_code'] = $postalCode;

        return $this;
    }

    public function withStreetLine1(string $streetLine1): AddressRequest
    {
        $this->filters['street_line1'] = $streetLine1;

        return $this;
    }

    public function withType(string $streetLine2): AddressRequest
    {
        $this->filters['street_line2'] = $streetLine2;

        return $this;
    }


    public function withIsPrimary(bool $isPrimary): AddressRequest
    {
        $this->filters['is_primary'] = $isPrimary;

        return $this;
    }
}