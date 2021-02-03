<?php

namespace App\Services\LastCommit\Foundation\Platform;

use App\Services\LastCommit\Contracts\Platform\Client as Contract;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

class Client implements Contract
{
    /**
     * Http client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Client constructor.
     *
     * @param \GuzzleHttp\Client $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Make HTTP GET request.
     *
     * @param string $url
     * @param array  $options
     *
     * @return array
     */
    public function get(string $url, array $options = []): array
    {
        $response = $this->httpClient->get($url, $options);
        return $this->parseResponse($response);
    }

    /**
     * Make HTTP POST request.
     *
     * @param string $url
     * @param array  $options
     *
     * @return array
     */
    public function post(string $url, array $options = []): array
    {
        $response = $this->httpClient->post($url, $options);
        return $this->parseResponse($response);
    }

    /**
     * Make request in passed method.
     *
     * @param string $method
     * @param string $url
     * @param array  $options
     *
     * @return array
     */
    public function request(string $method, string $url, array $options = []): array
    {
        $response = $this->httpClient->request($method, $url, $options);
        return $this->parseResponse($response);
    }

    /**
     * Parse response to array.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    protected function parseResponse(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();
        $body = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException(
                sprintf('Error occurred during platform response parsing.')
            );
        }

        return $body;
    }
}
