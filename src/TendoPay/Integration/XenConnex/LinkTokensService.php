<?php

namespace TendoPay\Integration\XenConnex;

use TendoPay\Integration\XenConnex\Api\EndpointCaller;
use TendoPay\Integration\XenConnex\Api\Tokens\Token;

class LinkTokensService
{
    private EndpointCaller $endpointCaller;

    public function __construct(EndpointCaller $endpointCaller)
    {
        $this->endpointCaller = $endpointCaller;
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function create(Token $token)
    {
        return $this->endpointCaller->call('POST', 'link_tokens', $token->toArray());
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function getDetails(string $linkTokenId, string $businessId)
    {
        return $this->endpointCaller->call('GET', sprintf('link_tokens/%s', $linkTokenId),
            [], ['business-id' => $businessId]);
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function invalidate(string $linkTokenId)
    {
        return $this->endpointCaller->call('DELETE', sprintf('link_tokens/%s', $linkTokenId));
    }
}