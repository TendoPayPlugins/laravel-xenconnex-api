<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Customer\Constants\KYCDocumentSubType;
use TendoPay\Integration\XenConnex\Api\Customer\Constants\KYCDocumentType;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class KYCDocumentRequest extends BaseFilter
{
    public static function builder(): KYCDocumentRequest
    {
        return new KYCDocumentRequest();
    }

    private function __construct()
    {
    }

    /**
     * @throws ValidationException
     */
    public function withCountry(string $country): KYCDocumentRequest
    {
        $this->addFilter('country', $country)->withMaxLength(2);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withType(string $type): KYCDocumentRequest
    {
        $this->addFilter('type', $type)
             ->withAvailableOptions(
                 KYCDocumentType::BIRTH_CERTIFICATE,
                 KYCDocumentType::BANK_STATEMENT,
                 KYCDocumentType::DRIVING_LICENSE,
                 KYCDocumentType::IDENTITY_CARD,
                 KYCDocumentType::PASSPORT,
                 KYCDocumentType::VISA,
                 KYCDocumentType::BUSINESS_REGISTRATION,
                 KYCDocumentType::BUSINESS_LICENSE);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withSubType(string $subType): KYCDocumentRequest
    {
        $this->addFilter('sub_type', $subType)
             ->withAvailableOptions(
                 KYCDocumentSubType::NATIONAL_ID,
                 KYCDocumentSubType::CONSULAR_ID,
                 KYCDocumentSubType::VOTER_ID,
                 KYCDocumentSubType::POSTAL_ID,
                 KYCDocumentSubType::RESIDENCE_PERMIT,
                 KYCDocumentSubType::TAX_ID,
                 KYCDocumentSubType::STUDENT_ID,
                 KYCDocumentSubType::MILITARY_ID,
                 KYCDocumentSubType::MEDICAL_ID,
                 KYCDocumentSubType::OTHERS
             );

        return $this;
    }

    public function withDocumentName(string $documentName): KYCDocumentRequest
    {
        $this->addFilter('document_name', $documentName);

        return $this;
    }

    public function withDocumentNumber(string $documentNumber): KYCDocumentRequest
    {
        $this->addFilter('document_number', $documentNumber);

        return $this;
    }

    public function withExpiresAt(string $expiresAt): KYCDocumentRequest
    {
        $this->addFilter('expires_at', $expiresAt);

        return $this;
    }

    public function withHolderName(string $holderName): KYCDocumentRequest
    {
        $this->addFilter('holder_name', $holderName);

        return $this;
    }
}