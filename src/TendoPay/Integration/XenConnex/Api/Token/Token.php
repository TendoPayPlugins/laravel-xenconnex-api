<?php

namespace TendoPay\Integration\XenConnex\Api\Token;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Token\Constants\CountryCode;
use TendoPay\Integration\XenConnex\Api\Token\Constants\InstitutionCode;
use TendoPay\Integration\XenConnex\Api\Token\Constants\ProductCode;
use TendoPay\Integration\XenConnex\Api\ValidationException;

class Token extends BaseFilter implements TokenWithCountryCodes, TokenWithInstitutionCodes
{
    /**
     * @param  string  $customerId
     * @param  array  $productCodes
     * @param  LinkProperties  $properties
     *
     * @return TokenWithCountryCodes|TokenWithInstitutionCodes
     * @throws ValidationException
     */
    public static function builder(string $customerId, array $productCodes, LinkProperties $properties)
    {
        $token = new Token($customerId, $productCodes, $properties);

        return new class($token) implements TokenWithCountryCodes, TokenWithInstitutionCodes {
            private Token $token;

            public function __construct(Token $token)
            {
                $this->token = $token;
            }

            public function withCountryCodes(array $countryCodes): Token
            {
                return $this->token->withCountryCodes($countryCodes);
            }

            public function withInstitutionCodes(array $institutionCodes): Token
            {
                return $this->token->withInstitutionCodes($institutionCodes);
            }
        };
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
                 ProductCode::TRANSACTION);

        $this->addFilter('properties', $properties);
    }

    /**
     * @throws ValidationException
     */
    public function withCountryCodes(array $countryCodes): Token
    {
        $this->addFilter('country_codes', $countryCodes)
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