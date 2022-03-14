<?php

namespace TendoPay\Integration\XenConnex\Api\Tokens;

use PHPUnit\Framework\TestCase;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class LinkPropertiesTest extends TestCase
{
    /**
     * @dataProvider validLinkProperties
     * @throws ValidationException
     */
    public function testShouldCreateLinkProperties(
        string $successRedirectUrl,
        string $failureRedirectUrl,
        string $cancelRedirectUrl
    ) {
        $result = LinkProperties::builder($successRedirectUrl, $failureRedirectUrl, $cancelRedirectUrl)->toArray();
        self::assertEquals($successRedirectUrl, $result['success_redirect_url']);
        self::assertEquals($failureRedirectUrl, $result['failure_redirect_url']);
        self::assertEquals($cancelRedirectUrl, $result['cancel_redirect_url']);
    }

    /**
     * @dataProvider invalidLinkProperties
     * @throws ValidationException
     */
    public function testShouldNotCreateValidProperties(
        string $successRedirectUrl,
        string $failureRedirectUrl,
        string $cancelRedirectUrl
    ) {
        $this->expectException(ValidationException::class);
        LinkProperties::builder($successRedirectUrl, $failureRedirectUrl, $cancelRedirectUrl)->toArray();
    }

    public function validLinkProperties(): array
    {
        return [
            [
                'https://success.full/#z5/zxy/45?a=@&ca=abc',
                'https://success.full.pl',
                'https://should.work.com.uk'
            ],
            [
                'https://sucess.full.com.uk/address',
                'https://success.full/xyz',
                'https://sh@uld.w@rk.c@m.uk/params/?a=123&b=abc'
            ],
            [
                'https://sucess.full',
                'https://succ@ss.full.pl/~3/params/?a=123&g=abc',
                'https://should.work.pl/xyz/123'
            ]
        ];
    }

    public function invalidLinkProperties(): array
    {
        return [
            [
                'http://success.full/#z5/zxy/45?a=@&ca=abc',
                'https://success.full.pl',
                'https://should.work.com.uk'
            ],
            [
                'https://sucess.full.com.uk/address',
                'ftp://success.full.pl',
                'https://sh@uld.w@rk.c@m.uk/params/?a=123&b=abc'
            ],
            [
                'https://sucess.full',
                'https://succ@ss.full.pl/~3/params/?a=123&g=abc',
                'should.work.com.uk'
            ]
        ];
    }
}
