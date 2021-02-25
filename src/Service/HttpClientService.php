<?php

declare(strict_types=1);

namespace Comics\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class HttpClientService
{
    public function get(string $url, array $options = []): string
    {
        $response = $this->create()->get($url, $options);

        return $response->getBody()->getContents();
    }

    public function post(string $url, array $options = []): ResponseInterface
    {
        return $this->create()->post($url, $options);
    }

    public function create(): Client
    {
        $headers = [
            'User-Agent' => 'Comics (https://github.com/mhauri/comics)',
            'Connection' => 'keep-alive',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Accept' => 'text/plain, */*',
            'Accept-Encoding' => 'gzip, deflate',
            'Accept-Language' => 'en-US,en;q=0.8',
        ];

        return new Client(
            [
                'timeout' => 3.0,
                'headers' => $headers,
            ]
        );
    }
}
