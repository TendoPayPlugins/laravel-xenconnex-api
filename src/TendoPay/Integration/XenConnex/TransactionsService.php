<?php

namespace TendoPay\Integration\XenConnex;

use GuzzleHttp\Exception\ClientException;
use TendoPay\Integration\XenConnex\Api\EndpointCaller;
use TendoPay\Integration\XenConnex\Api\Transactions\GetTransactionsParams;

class TransactionsService
{
    private EndpointCaller $endpointCaller;

    public function __construct(EndpointCaller $endpointCaller)
    {
        $this->endpointCaller = $endpointCaller;
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function get(GetTransactionsParams $params)
    {

        try {
            $received = $this->endpointCaller->call('GET', 'transactions', [], [], $params->getParams());

            return data_get($received, 'data');
        } catch (ClientException $exception) {
            return $exception;
        }
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function refresh(string $linkTokenId)
    {
        try {
            $received = $this->endpointCaller->call('GET', 'transactions', [], ['link-token-id' => $linkTokenId]);

            return data_get($received, 'data');
        } catch (ClientException $exception) {
            return $exception;
        }
    }
}