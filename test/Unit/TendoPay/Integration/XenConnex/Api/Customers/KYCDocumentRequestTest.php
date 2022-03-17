<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use PHPUnit\Framework\TestCase;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\KYCDocumentSubType;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\KYCDocumentType;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class KYCDocumentRequestTest extends TestCase
{
    /**
     * @dataProvider validIndividualDetails
     * @throws ValidationException
     */
    public function testShouldCreateKYCDocumentRequest(
        ?string $country,
        ?string $type,
        ?string $subType,
        ?string $documentName,
        ?string $documentNumber,
        ?string $expiresAt,
        ?string $holderName
    ) {
        $builder = KYCDocumentRequest::builder();
        if ($country !== null) {
            $builder->withCountry($country);
        }
        if ($type !== null) {
            $builder->withType($type);
        }
        if ($subType !== null) {
            $builder->withSubType($subType);
        }
        if ($documentName !== null) {
            $builder->withDocumentName($documentName);
        }
        if ($documentNumber !== null) {
            $builder->withDocumentNumber($documentNumber);
        }
        if ($expiresAt !== null) {
            $builder->withExpiresAt($expiresAt);
        }
        if ($holderName !== null) {
            $builder->withHolderName($holderName);
        }

        $result = $builder->toArray();

        if ($country !== null) {
            self::assertEquals($country, $result['country']);
        }
        if ($type !== null) {
            self::assertEquals($type, $result['type']);
        }
        if ($subType !== null) {
            self::assertEquals($subType, $result['sub_type']);
        }
        if ($documentName !== null) {
            self::assertEquals($documentName, $result['document_name']);
        }
        if ($documentNumber !== null) {
            self::assertEquals($documentNumber, $result['document_number']);
        }
        if ($expiresAt !== null) {
            self::assertEquals($expiresAt, $result['expires_at']);
        }
        if ($holderName !== null) {
            self::assertEquals($holderName, $result['holder_name']);
        }
    }

    public function validIndividualDetails(): array
    {
        return [
            [
                'EN', KYCDocumentType::BIRTH_CERTIFICATE, KYCDocumentSubType::VOTER_ID, '', '1234', '12-03-1990',
                'Holder'
            ],
            [
                'ND', KYCDocumentType::VISA, KYCDocumentSubType::CONSULAR_ID, '', '1234', '12-03-1990',
                'Holder'
            ]
        ];
    }
}
