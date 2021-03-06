<?php

namespace TendoPay\Integration\XenConnex\Api\Tokens;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;
use TendoPay\Integration\XenConnex\Api\Tokens\Constants\CountryCode;
use TendoPay\Integration\XenConnex\Api\Tokens\Constants\InstitutionCode;
use TendoPay\Integration\XenConnex\Api\Tokens\Constants\ProductCode;

class Token extends BaseFilter
{
    /**
     * @param  string  $customerId
     * @param  array  $productCodes
     * @param  LinkProperties  $properties
     *
     * @return Token
     * @throws ValidationException
     */
    public static function builder(string $customerId, array $productCodes, LinkProperties $properties): Token
    {
        return new Token($customerId, $productCodes, $properties);
    }

    /**
     * @throws ValidationException
     */
    private function __construct(string $customerId, array $productCodes, LinkProperties $properties)
    {
        $this->addFilter('customer_id',
            $customerId)->withRegexCheck('/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b/');
        $this->addFilter('product_codes', $productCodes)
             ->withAvailableOptions(
                 ProductCode::TRANSACTION)
             ->withNotEmptyValue();

        $this->addFilter('properties', $properties->toArray())
             ->withNotEmptyValue();

        $this->addRequiredFieldsOption(['country_codes']);
        $this->addRequiredFieldsOption(['institution_codes']);
    }

    /**
     * @throws ValidationException
     */
    public function withCountryCodes(array $countryCodes): Token
    {
        $this->addFilter('country_codes', $countryCodes)
             ->withNotEmptyValue()
             ->withAvailableOptions(
                 CountryCode::ID,
                 CountryCode::PH);

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function withInstitutionCodes(array $institutionCodes): Token
    {
        $this->addFilter('institution_codes', $institutionCodes)
             ->withNotEmptyValue()
             ->withAvailableOptions(
                 InstitutionCode::ID_BCA,
                 InstitutionCode::ID_BCA_CORPORATE,
                 InstitutionCode::ID_BNI,
                 InstitutionCode::ID_BNI_CORPORATE,
                 InstitutionCode::ID_BPJS,
                 InstitutionCode::ID_BRI,
                 InstitutionCode::ID_BRI_CORPORATE,
                 InstitutionCode::ID_BSI,
                 InstitutionCode::ID_CIMB,
                 InstitutionCode::ID_DANA,
                 InstitutionCode::ID_DANAMON,
                 InstitutionCode::ID_DBS,
                 InstitutionCode::ID_GOPAY,
                 InstitutionCode::ID_MANDIRI,
                 InstitutionCode::ID_MANDIRI_CORPORATE.
                 InstitutionCode::ID_OVO,
                 InstitutionCode::ID_PERMATA,
                 InstitutionCode::ID_UOB,
                 InstitutionCode::PH_BDO,
                 InstitutionCode::PH_BPI,
                 InstitutionCode::PH_RCBC,
                 InstitutionCode::PH_SECURITY_BANK);

        return $this;
    }
}