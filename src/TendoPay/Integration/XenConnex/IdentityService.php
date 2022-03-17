<?php

namespace TendoPay\Integration\XenConnex;

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
        return $this->endpointCaller->call('GET', 'identity', [], [], ['link_token_id' => $linkTokenId]);
    }
}