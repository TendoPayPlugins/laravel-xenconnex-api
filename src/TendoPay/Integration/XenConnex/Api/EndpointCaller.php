<?php

namespace TendoPay\Integration\XenConnex\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class EndpointCaller
{
    private $client;
    private $apiUrl;
    private $apiKey;

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

    public function call(string $method, $url, array $payload = [])
    {
        $options = [
            "headers" => [
                "Accept"       => "*/*",
                "Content-type" => "application/json"
            ],
            "auth"    => [
                $this->apiKey, ""
            ]
        ];

        if ( ! empty($payload)) {
            $options["json"] = $payload;
        }

        try {
            $response = $this->client->request($method, $this->apiUrl.$url, $options);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
        }
        if ($response->getStatusCode() === 201) {
            return json_decode($response->getBody()->getContents());
        } else {
            $this->handleErrors($response);
            // no return, will throw exception
        }
    }

    private function handleErrors(ResponseInterface $response)
    {

    }

}