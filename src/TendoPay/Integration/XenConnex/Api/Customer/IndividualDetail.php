<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Customer\Constants\Gender;
use TendoPay\Integration\XenConnex\Api\ValidationException;

class IndividualDetail extends BaseFilter
{
    /**
     * @throws ValidationException
     */
    public static function builder(string $givenNames): IndividualDetail
    {
        return new IndividualDetail($givenNames);
    }

    /**
     * @throws ValidationException
     */
    private function __construct(string $givenNames)
    {
        $this->addFilter('given_names', $givenNames)->withMaxLength(255);
    }

    /**
     * @throws ValidationException
     */
    public function withSurname(string $surname): IndividualDetail
    {
        $this->addFilter('surname', $surname)->withMaxLength(255);

        return $this;
    }

    public function withGender(string $gender): IndividualDetail
    {
        $this->addFilter('gender', $gender)
             ->withAvailableOptions(Gender::FEMALE, Gender::MALE, Gender::OTHER);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withDateOfBirth(string $dateOfBirth): IndividualDetail
    {
        $this->addFilter('date_of_birth', $dateOfBirth)->withMaxLength(30);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withNationality(string $nationality): IndividualDetail
    {
        $this->addFilter('nationality', $nationality)->withMaxLength(2);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withPlaceOfBirth(string $placeOfBirth): IndividualDetail
    {
        $this->addFilter('place_of_birth', $placeOfBirth)->withMaxLength(255);

        return $this;
    }

    public function withEmployment(EmploymentDetail $employment): IndividualDetail
    {
        $this->addFilter('employment', $employment->toArray());

        return $this;
    }
}