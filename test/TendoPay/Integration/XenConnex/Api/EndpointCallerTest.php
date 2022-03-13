<?php

namespace TendoPay\Integration\XenConnex\Api;

use Orchestra\Testbench\TestCase;
use TendoPay\Integration\XenConnex\XenConnexServiceProvider;


class EndpointCallerTest extends TestCase
{

    protected function getPackageProviders($app): array
    {
        return [XenConnexServiceProvider::class];
    }


//    public function testCall()
//    {
//        /**
//         * @var $service EndpointCaller
//         */
//        $service = $this->app->get(EndpointCaller::class);
//        $result  = $service->call("GET", "transactions?count=100&offset=0");
//        error_log($result);
//    }
}
