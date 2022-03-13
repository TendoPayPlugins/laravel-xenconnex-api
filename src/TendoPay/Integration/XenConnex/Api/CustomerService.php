<?php

namespace TendoPay\Integration\XenConnex\Api;

use GuzzleHttp\Exception\ClientException;
use TendoPay\Integration\XenConnex\Api\Customer\Customer;

class CustomerService
{
    /** @var EndpointCaller */
    private $endpointCaller;

    public function __construct(EndpointCaller $endpointCaller)
    {
        $this->endpointCaller = $endpointCaller;
    }

    public function create(Customer $customer)
    {
        try {
            $received = $this->endpointCaller->call("POST", "customers", $customer->toArray());

            return data_get($received, 'data');
        } catch (ClientException $exception) {
            return $exception;
        }
    }
}