<?php

namespace TendoPay\Integration\XenConnex\Api;

use GuzzleHttp\Exception\ClientException;

class IdentityService
{
    private EndpointCaller $endpointCaller;

    public function __construct(EndpointCaller $endpointCaller)
    {
        $this->endpointCaller = $endpointCaller;
    }

    public function get(string $linkTokenId)
    {
        try {
            $received = $this->endpointCaller->call('GET', sprintf('identity/%s', $linkTokenId));

            return data_get($received, 'data');
        } catch (ClientException $exception) {
            return $exception;
        }
    }
}