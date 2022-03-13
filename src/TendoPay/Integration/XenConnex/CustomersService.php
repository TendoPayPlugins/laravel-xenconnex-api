<?php

namespace TendoPay\Integration\XenConnex;

use GuzzleHttp\Exception\ClientException;
use TendoPay\Integration\XenConnex\Api\Customers\Customer;
use TendoPay\Integration\XenConnex\Api\EndpointCaller;

class CustomersService
{
    private EndpointCaller $endpointCaller;

    public function __construct(EndpointCaller $endpointCaller)
    {
        $this->endpointCaller = $endpointCaller;
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function create(Customer $customer)
    {
        try {
            return $this->endpointCaller->call("POST", "customers", $customer->toArray());
        } catch (ClientException $exception) {
            return $exception;
        }
    }
}