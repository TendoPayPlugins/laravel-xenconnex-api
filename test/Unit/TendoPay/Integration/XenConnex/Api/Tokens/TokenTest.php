<?php

namespace TendoPay\Integration\XenConnex\Api\Tokens;

use PHPUnit\Framework\TestCase;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

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
     * @throws ValidationException
     */
    public function testShouldCreateToken()
    {
        $customerId = '00000000-1111-2222-3333-444444444444';
        $result     = Token::builder($customerId, [], $this->validLinkProperties)->withInstitutionCodes([])->toArray();
        self::assertEquals($customerId, $result['customer_id']);
    }
}
