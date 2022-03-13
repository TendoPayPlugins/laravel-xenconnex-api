<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

use TendoPay\Integration\XenConnex\Api\BaseFilter;

class IndividualDetail extends BaseFilter
{
    public static function builder(string $givenNames): IndividualDetail
    {
        return new IndividualDetail([
            'given_names' => $givenNames
        ]);
    }

    private function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function withSurname(string $surname): IndividualDetail
    {
        $this->filters['surname'] = $surname;

        return $this;
    }

    public function withGender(string $gender): IndividualDetail
    {
        $this->filters['gender'] = $gender;

        return $this;
    }

    public function withDateOfBirth(string $dateOfBirth): IndividualDetail
    {
        $this->filters['date_of_birth'] = $dateOfBirth;

        return $this;
    }

    public function withNationality(string $nationality): IndividualDetail
    {
        $this->filters['nationality'] = $nationality;

        return $this;
    }

    public function withPlaceOfBirth(string $placeOfBirth): IndividualDetail
    {
        $this->filters['place_of_birth'] = $placeOfBirth;

        return $this;
    }

    public function withEmployment(EmploymentDetail $employment): IndividualDetail
    {
        $this->filters['employment'] = $employment;

        return $this;
    }
}