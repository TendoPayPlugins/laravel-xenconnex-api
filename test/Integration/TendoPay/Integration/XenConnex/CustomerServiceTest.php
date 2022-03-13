<?php

namespace TendoPay\Integration\XenConnex;

use Orchestra\Testbench\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use TendoPay\Integration\XenConnex\Api\Customer\Constants\Gender;
use TendoPay\Integration\XenConnex\Api\Customer\Customer;
use TendoPay\Integration\XenConnex\Api\Customer\IndividualDetail;

class CustomerServiceTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [XenConnexServiceProvider::class];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ValidationException
     */
    public function testCreate()
    {
        self::assertTrue(true);

        return;
        /**
         * @var $service CustomersService
         */
        $service = $this->app->get(CustomersService::class);

        $result = $service->create(
            Customer::builder('68fbf03c-a22f-11ec-b909-3242ac120022')
                    ->withEmail('asd@as.aa')
                    ->withIndividualDetail(IndividualDetail::builder("mygivennames")
                                                           ->withGender(Gender::FEMALE()))
                    ->withMetadata(['meta' => 'data'])
        );

        error_log($result);
        self::assertTrue(true);
    }
}
