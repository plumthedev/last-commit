<?php

namespace App\Services\LastCommit\Contracts\Platform;

interface Client
{
    /**
     * Make HTTP GET request.
     *
     * @param string $url
     * @param array  $options
     *
     * @return array
     */
    public function get(string $url, array $options = []): array;

    /**
     * Make HTTP POST request.
     *
     * @param string $url
     * @param array  $options
     *
     * @return array
     */
    public function post(string $url, array $options = []): array;

    /**
     * Make request in passed method.
     *
     * @param string $method
     * @param string $url
     * @param array  $options
     *
     * @return array
     */
    public function request(string $method, string $url, array $options = []): array;
}
