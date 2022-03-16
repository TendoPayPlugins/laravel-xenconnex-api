<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use PHPUnit\Framework\TestCase;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\Gender;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class IndividualDetailTest extends TestCase
{
    /**
     * @dataProvider validIndividualDetails
     * @throws ValidationException
     */
    public function testShouldCreateBusinessDetail(
        string $givenNames,
        ?string $surname,
        ?string $gender,
        ?string $dateOfBirth,
        ?string $nationality,
        ?string $placeOfBirth
    ) {
        $employment = EmploymentDetail::builder()->withEmployerName('Employer');
        $builder    = IndividualDetail::builder($givenNames);
        if ($surname !== null) {
            $builder->withSurname($surname);
        }
        if ($gender !== null) {
            $builder->withGender($gender);
        }
        if ($dateOfBirth !== null) {
            $builder->withDateOfBirth($dateOfBirth);
        }
        if ($nationality !== null) {
            $builder->withNationality($nationality);
        }
        if ($placeOfBirth !== null) {
            $builder->withPlaceOfBirth($placeOfBirth);
        }
        $builder->withEmployment($employment);

        $result = $builder->toArray();

        if ($surname !== null) {
            self::assertEquals($surname, $result['surname']);
        }
        if ($gender !== null) {
            self::assertEquals($gender, $result['gender']);
        }
        if ($dateOfBirth !== null) {
            self::assertEquals($dateOfBirth, $result['date_of_birth']);
        }
        if ($nationality !== null) {
            self::assertEquals($nationality, $result['nationality']);
        }
        if ($placeOfBirth !== null) {
            self::assertEquals($placeOfBirth, $result['place_of_birth']);
        }

        self::assertEquals($employment->toArray(), $result['employment']);
    }

    public function validIndividualDetails(): array
    {
        return [['Name', 'Surname', Gender::MALE, '12-03-1990', 'EN', 'England']];
    }
}
