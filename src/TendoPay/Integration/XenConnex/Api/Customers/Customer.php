<?php

namespace TendoPay\Integration\XenConnex\Api\Customers;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class Customer extends BaseFilter
{

    /**
     * @param  string  $referenceId
     *
     * @return Customer
     * @throws ValidationException
     */
    public static function builder(string $referenceId): Customer
    {
        return new Customer($referenceId);
    }

    /**
     * @throws ValidationException
     */
    private function __construct(string $referenceId)
    {
        $this->addFilter('reference_id', $referenceId)->withMaxLength(255);
        $this->addFilter('type', 'INDIVIDUAL');
        $this->addRequiredFieldsOption(['mobile_number']);
        $this->addRequiredFieldsOption(['email']);
    }

    /**
     * @throws ValidationException
     */
    public function withDescription(string $description): Customer
    {
        $this->addFilter('description', $description)->withMaxLength(500);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withPhoneNumber(string $phoneNumber): Customer
    {
        $this->addFilter('phone_number', $phoneNumber)->withMaxLength(50);

        return $this;
    }

    public function withIndividualDetail(IndividualDetail $individualDetail): Customer
    {
        $this->addFilter('individual_detail', $individualDetail->toArray());

        return $this;
    }

    public function withBusinessDetail(BusinessDetail $businessDetail): Customer
    {
        $this->addFilter('business_detail', $businessDetail->toArray());

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withEmail(string $email): Customer
    {
        $this->addFilter('email', $email)->withMaxLength(255);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withMobileNumber(string $mobileNumber): Customer
    {
        $this->addFilter('mobile_number', $mobileNumber)
             ->withMaxLength(50)
             ->withRegexCheck('/^\+[1-9]\d{1,14}$/');

        return $this;
    }

    public function withAddresses(AddressRequest ...$addresses): Customer
    {
        $this->addFilter('addresses', array_map(function ($address) {
            return $address->toArray();
        }, $addresses));

        return $this;
    }

    public function withIdentityAccounts(IdentityAccountRequest ...$identityAccounts): Customer
    {
        $this->addFilter('identity_accounts', array_map(function ($accountRequest) {
            return $accountRequest->toArray();
        }, $identityAccounts));

        return $this;
    }

    public function withKYCDocuments(KYCDocumentRequest ...$kycDocuments): Customer
    {
        $this->addFilter('kyc_documents', array_map(function ($kycDocument) {
            return $kycDocument->toArray();
        }, $kycDocuments));

        return $this;
    }

    public function withMetadata($metadata): Customer
    {
        $this->addFilter('metadata', $metadata);

        return $this;
    }
}