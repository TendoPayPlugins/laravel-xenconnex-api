<?php

namespace TendoPay\Integration\XenConnex\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use TendoPay\Integration\XenConnex\Api\Exceptions\ApiEndpointErrorException;

class EndpointCaller
{
    private ClientInterface $client;
    private string $apiUrl;
    private string $apiKey;

    /**
     * @param  ClientInterface  $client
     * @param  string  $apiUrl
     * @param  string  $apiKey
     */
    public function __construct(ClientInterface $client, string $apiUrl, string $apiKey)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->client = $client;
    }

    /**
     * @throws ApiEndpointErrorException
     */
    public function call(string $method, $url, array $payload = [], array $headers = [], array $queryParams = [])
    {
        $headers['Accept']       = '*/*';
        $headers['Content-type'] = 'application/json';
        $options                 = [
            'headers' => $headers,
            'auth'    => [
                $this->apiKey, ''
            ]
        ];
        if ( ! empty($queryParams)) {
            $options['query'] = $queryParams;
        }

        if ( ! empty($payload)) {
            $options['json'] = $payload;
        }

        try {
            $response = $this->client->request($method, $this->apiUrl.$url, $options);
            if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                return json_decode($response->getBody()->getContents());
            } else {
                throw new ApiEndpointErrorException($response->getBody()->getContents(),
                    'Status code: '.$response->getStatusCode());
            }
        } catch (BadResponseException $exception) {
            $exceptionResult = json_decode($exception->getResponse()->getBody()->getContents());
            throw new ApiEndpointErrorException(
                $exceptionResult->message ?? '',
                $exceptionResult->error_code ?? '',
                $exceptionResult->errors ?? []);
        }
    }
}