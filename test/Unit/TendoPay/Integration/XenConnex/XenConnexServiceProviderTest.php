<?php

namespace TendoPay\Integration\XenConnex;


use Orchestra\Testbench\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use TendoPay\Integration\XenConnex\Api\EndpointCaller;

class XenConnexServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [XenConnexServiceProvider::class];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testShouldRegisterEndpointCaller()
    {
        $service = $this->app->get(EndpointCaller::class);
        $this->assertEquals(EndpointCaller::class, get_class($service));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testShouldRegisterCustomerService()
    {
        $service = $this->app->get(CustomersService::class);
        $this->assertEquals(CustomersService::class, get_class($service));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testShouldRegisterLinkTokensService()
    {
        $service = $this->app->get(LinkTokensService::class);
        $this->assertEquals(LinkTokensService::class, get_class($service));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testShouldRegisterTransactionsService()
    {
        $service = $this->app->get(TransactionsService::class);
        $this->assertEquals(TransactionsService::class, get_class($service));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testShouldRegisterIdentityService()
    {
        $service = $this->app->get(IdentityService::class);
        $this->assertEquals(IdentityService::class, get_class($service));
    }
}
