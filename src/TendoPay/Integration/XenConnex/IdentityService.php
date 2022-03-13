<?php

namespace TendoPay\Integration\XenConnex;

use GuzzleHttp\Exception\ClientException;
use TendoPay\Integration\XenConnex\Api\EndpointCaller;

class IdentityService
{
    private EndpointCaller $endpointCaller;

    public function __construct(EndpointCaller $endpointCaller)
    {
        $this->endpointCaller = $endpointCaller;
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
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