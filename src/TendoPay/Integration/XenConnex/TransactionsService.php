<?php

namespace TendoPay\Integration\XenConnex;

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
    public function get(string $linkTokenId, GetTransactionsParams $params = null)
    {
        return $this->endpointCaller->call('GET', 'transactions', [], ['link-token-id' => $linkTokenId],
            isset($params) ? $params->getParams() : []);
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function refresh(string $linkTokenId)
    {
        return $this->endpointCaller->call('GET', 'transactions', [], ['link-token-id' => $linkTokenId]);
    }
}