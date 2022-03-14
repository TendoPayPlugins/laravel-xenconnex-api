<?php

namespace TendoPay\Integration\XenConnex;

use Orchestra\Testbench\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use TendoPay\Integration\XenConnex\Api\Customers\Customer;
use TendoPay\Integration\XenConnex\Api\Customers\IndividualDetail;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;
use TendoPay\Integration\XenConnex\Api\Tokens\LinkProperties;
use TendoPay\Integration\XenConnex\Api\Tokens\Token;

class LinkTokensServiceTest extends TestCase
{

    private static string $uuid;

    protected function getPackageProviders($app): array
    {
        return [XenConnexServiceProvider::class];
    }


    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ValidationException
     */
    private function beforeEach(): void
    {
        if (isset(self::$uuid)) {
            return;
        }
        self::$uuid = uniqid();
        /**
         * @var $service CustomersService
         */
        $service = $this->app->get(CustomersService::class);
        $result = $service->create(
            Customer::builder(self::$uuid)
                    ->withEmail('valid@email.com')
                    ->withIndividualDetail(IndividualDetail::builder('Given Names James'))
        );
        error_log($result);
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ValidationException
     */
    public function testShouldCreateToken()
    {
        $this->beforeEach();
        /**
         * @var $service LinkTokensService
         */
        $service    = $this->app->get(LinkTokensService::class);
        $properties = LinkProperties::builder('https://success.full', 'https://success.full',
            'https://success.full');

        $result = $service->create(Token::builder(self::$uuid, ['TRANSACTION'],
            $properties)->withInstitutionCodes(['ID_BCA']));
        self::assertEquals(self::$uuid, $result->customer_id);
    }
}
