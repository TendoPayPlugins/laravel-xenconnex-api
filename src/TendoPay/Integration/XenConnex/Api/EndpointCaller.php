<?php

namespace TendoPay\Integration\XenConnex\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
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
        } catch (GuzzleException $exception) {
            $response = $exception->getMessage();
        }
        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 201) {
            return json_decode($response->getBody()->getContents());
        } else {
            $this->handleErrors($response);
            // no return, will throw exception
        }
    }

    /**
     * @throws ApiEndpointErrorException
     */
    private function handleErrors(ResponseInterface $response)
    {
        $originalError = json_decode($response->getBody()->getContents());
        $errorCode     = $originalError->error_code;
        $message       = $originalError->message;
        throw new ApiEndpointErrorException(
            sprintf(
                "Got error code: %s, error class: %s. Message: %s",
                $response->getStatusCode(),
                $errorCode,
                $message
            )
        );
    }

}