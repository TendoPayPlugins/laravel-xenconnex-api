<?php

namespace TendoPay\Integration\XenConnex\Api;

use Orchestra\Testbench\TestCase;
use TendoPay\Integration\XenConnex\Api\Customer\AddressRequest;
use TendoPay\Integration\XenConnex\Api\Customer\Customer;
use TendoPay\Integration\XenConnex\Api\Customer\IndividualDetail;
use TendoPay\Integration\XenConnex\XenConnexServiceProvider;

class CustomerServiceTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [XenConnexServiceProvider::class];
    }

//    public function testCreate()
//    {
//        /**
//         * @var $service CustomerService
//         */
//        $service = $this->app->get(CustomerService::class);
//
//        $result  = $service->create(
//            Customer::builder('88fbf03c-a22f-11ec-b909-3242ac120022')
//                    ->withEmail('asd@as.aa')
//                    ->withIndividualDetail(IndividualDetail::builder("mygivennames"))
//        );
//
//        error_log($result);
//        self::assertTrue(true);
//    }
}
