<?php

namespace TendoPay\Integration\XenConnex\Api;

use GuzzleHttp\Exception\ClientException;

class TransactionsService
{
    private EndpointCaller $endpointCaller;

    public function __construct(EndpointCaller $endpointCaller)
    {
        $this->endpointCaller = $endpointCaller;
    }

    public function get(?int $count = null, ?int $offset = null, ?string $startDate = null, ?string $endDate = null)
    {
        $params = [];
        if (isset($count)) {
            $params['count'] = $count;
        }
        if (isset($offset)) {
            $params['offset'] = $offset;
        }
        if (isset($startDate)) {
            $params['startDate'] = $startDate;
        }
        if (isset($endDate)) {
            $params['endDate'] = $endDate;
        }
        try {
            $received = $this->endpointCaller->call('GET', 'transactions', [], [], $params);

            return data_get($received, 'data');
        } catch (ClientException $exception) {
            return $exception;
        }
    }

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