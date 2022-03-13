<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class AddressRequest extends BaseFilter
{
    /**
     * @throws ValidationException
     */
    public static function builder(string $country): AddressRequest
    {
        return new AddressRequest($country);
    }

    /**
     * @throws ValidationException
     */
    private function __construct(string $country)
    {
        $this->addFilter('country', $country)->withMaxLength(2);
    }

    /**
     * @throws ValidationException
     */
    public function withCategory(string $category): AddressRequest
    {
        $this->addFilter('category', $category)->withMaxLength(255);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withProvinceState(string $provinceState): AddressRequest
    {
        $this->addFilter('province_state', $provinceState)->withMaxLength(255);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withCity(string $city): AddressRequest
    {
        $this->addFilter('city', $city)->withMaxLength(255);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withPostalCode(string $postalCode): AddressRequest
    {
        $this->addFilter('postal_code', $postalCode)->withMaxLength(255);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withStreetLine1(string $streetLine1): AddressRequest
    {
        $this->addFilter('street_line1', $streetLine1)->withMaxLength(255);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withType(string $streetLine2): AddressRequest
    {
        $this->addFilter('street_line2', $streetLine2)->withMaxLength(255);

        return $this;
    }


    public function withIsPrimary(bool $isPrimary): AddressRequest
    {
        $this->addFilter('is_primary', $isPrimary);

        return $this;
    }
}