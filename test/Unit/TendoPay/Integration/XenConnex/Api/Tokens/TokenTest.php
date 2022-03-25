<?php

namespace TendoPay\Integration\XenConnex\Api\Tokens;

use PHPUnit\Framework\TestCase;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;
use TendoPay\Integration\XenConnex\Api\Tokens\Constants\CountryCode;
use TendoPay\Integration\XenConnex\Api\Tokens\Constants\InstitutionCode;
use TendoPay\Integration\XenConnex\Api\Tokens\Constants\ProductCode;

class TokenTest extends TestCase
{
    private LinkProperties $validLinkProperties;

    /**
     * @throws ValidationException
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->validLinkProperties = LinkProperties::builder('https://success.full', 'https://success.full',
            'https://success.full');
    }


    /**
     * @dataProvider validTokens
     * @throws ValidationException
     */
    public function testShouldCreateToken(
        ?string $customerId,
        ?array $productCodes,
        ?LinkProperties $properties,
        ?array $institutionCodes,
        ?array $countryCodes
    ) {
        $builder = Token::builder($customerId, $productCodes, $properties);
        if ($institutionCodes !== null) {
            $builder = $builder->withInstitutionCodes($institutionCodes);
        }
        if ($countryCodes !== null) {
            $builder = $builder->withCountryCodes($countryCodes);
        }

        $result = $builder->toArray();
        self::assertEquals($customerId, $result['customer_id']);
    }

    /**
     * @dataProvider invalidTokens
     * @throws ValidationException
     */
    public function testShouldNotCreateToken(
        string $customerId,
        array $productCodes,
        LinkProperties $properties,
        ?array $institutionCodes,
        ?array $countryCodes
    ) {
        $this->expectException(ValidationException::class);
        $builder = Token::builder($customerId, $productCodes, $properties);
        if ($institutionCodes !== null) {
            $builder->withInstitutionCodes($institutionCodes);
        }
        if ($countryCodes !== null) {
            $builder->withCountryCodes($countryCodes);
        }
        $builder->toArray();
    }

    public function validTokens(): array
    {
        return [
            [
                '00000000-1111-2222-3333-444444444444',
                [ProductCode::TRANSACTION],
                $this->validLinkProperties,
                [InstitutionCode::ID_BCA, InstitutionCode::ID_PERMATA],
                [CountryCode::PH, CountryCode::ID]
            ],
            [
                '00000000-1111-aef2-3333-444444444444',
                [ProductCode::TRANSACTION],
                $this->validLinkProperties,
                null,
                [CountryCode::PH]
            ],
            [
                'afd00000-1111-2222-3333-444444444444',
                [ProductCode::TRANSACTION],
                $this->validLinkProperties,
                [InstitutionCode::ID_BCA],
                null
            ]
        ];
    }

    public function invalidTokens(): array
    {
        return [
            [
                '00000000-1111-2222-3333-444444444444',
                [ProductCode::TRANSACTION],
                $this->validLinkProperties,
                array(),
                [CountryCode::PH]
            ],
            [
                '00000000-1111-2222-3333-444444444444',
                [ProductCode::TRANSACTION],
                $this->validLinkProperties,
                [],
                []
            ],
            [
                '0000000z-1111-aef2-3333-444444444444',
                [ProductCode::TRANSACTION],
                $this->validLinkProperties,
                [],
                [CountryCode::PH]
            ], [
                '00000000-1111-2222-3333-444444444444',
                [ProductCode::TRANSACTION],
                $this->validLinkProperties,
                ['unknown'],
                [CountryCode::PH]
            ], [
                '00000000-1111-2222-3333-444444444444',
                [ProductCode::TRANSACTION],
                $this->validLinkProperties,
                [InstitutionCode::ID_BCA],
                ['unknown']
            ], [
                '00000000-1111-2222-3333-444444444444',
                [ProductCode::TRANSACTION],
                $this->validLinkProperties,
                null,
                null
            ]
        ];
    }
}
