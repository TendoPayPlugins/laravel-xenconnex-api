<?php

namespace TendoPay\Integration\XenConnex;

use GuzzleHttp\Exception\ClientException;
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
        try {
            $received = $this->endpointCaller->call('POST', 'link_tokens', $token->toArray());

            return data_get($received, 'data');
        } catch (ClientException $exception) {
            return $exception;
        }
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function getDetails(string $linkTokenId, string $businessId)
    {
        try {
            $received = $this->endpointCaller->call('GET', sprintf('link_tokens/%s', $linkTokenId),
                [], ['business-id' => $businessId]);

            return data_get($received, 'data');
        } catch (ClientException $exception) {
            return $exception;
        }
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function invalidate(string $linkTokenId)
    {
        try {
            $received = $this->endpointCaller->call('DELETE', sprintf('link_tokens/%s', $linkTokenId));

            return data_get($received, 'data');
        } catch (ClientException $exception) {
            return $exception;
        }
    }
}