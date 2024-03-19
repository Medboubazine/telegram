<?php

namespace Medboubazine\Telegram\Core\Traits;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

trait GuzzleHttpTrait
{
    /**
     * get Base Uri
     *
     * @return string
     */
    public function getBaseUri(): string
    {
        return "https://api.telegram.org/bot{$this->credentials->token}/";
    }
    /**
     * __request
     *
     * @return ResponseInterface
     */
    public function __request($method, $uri, $headers = [], $options = []): ResponseInterface
    {
        $client = new Client([
            "base_uri" => $this->getBaseUri(),
            'timeout'  => 10,
            "allow_redirects" => false,
            "http_errors" => false,
            "verify" => true,
            "headers" => [
                "Accept" => "application/json",
                ...$headers,
            ],
        ]);

        return $client->request($method, $uri, $options);
    }
}
