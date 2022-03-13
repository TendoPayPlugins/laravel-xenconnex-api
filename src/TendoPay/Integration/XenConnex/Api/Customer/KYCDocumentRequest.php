<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

use TendoPay\Integration\XenConnex\Api\BaseFilter;

class KYCDocumentRequest extends BaseFilter
{
    public static function builder(): KYCDocumentRequest
    {
        return new KYCDocumentRequest();
    }

    private function __construct()
    {
    }

    public function withCountry(string $country): KYCDocumentRequest
    {
        $this->filters['country'] = $country;

        return $this;
    }

    public function withType(string $type): KYCDocumentRequest
    {
        $this->filters['type'] = $type;

        return $this;
    }

    public function withSubType(string $subType): KYCDocumentRequest
    {
        $this->filters['sub_type'] = $subType;

        return $this;
    }

    public function withDocumentName(string $documentName): KYCDocumentRequest
    {
        $this->filters['document_name'] = $documentName;

        return $this;
    }

    public function withDocumentNumber(string $documentNumber): KYCDocumentRequest
    {
        $this->filters['document_number'] = $documentNumber;

        return $this;
    }

    public function withExpiresAt(string $expiresAt): KYCDocumentRequest
    {
        $this->filters['expires_at'] = $expiresAt;

        return $this;
    }

    public function withHolderName(string $holderName): KYCDocumentRequest
    {
        $this->filters['holder_name'] = $holderName;

        return $this;
    }
}