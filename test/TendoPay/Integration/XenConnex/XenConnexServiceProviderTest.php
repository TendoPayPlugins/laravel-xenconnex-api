<?php

namespace TendoPay\Integration\XenConnex;


use Orchestra\Testbench\TestCase;
use TendoPay\Integration\XenConnex\Api\CustomerService;
use TendoPay\Integration\XenConnex\Api\EndpointCaller;

class XenConnexServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [XenConnexServiceProvider::class];
    }

    public function testShouldRegisterEndpointCaller()
    {
        $service = $this->app->get(EndpointCaller::class);
        $this->assertEquals(get_class($service), EndpointCaller::class);
    }

    public function testShouldRegisterCustomerService()
    {
        $service = $this->app->get(CustomerService::class);
        $this->assertEquals(get_class($service), CustomerService::class);
    }
}
