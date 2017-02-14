<?php

namespace Fab\Imagga;

use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var string
     */
    protected $baseUrl = 'http://api.imagga.com/v1';

    /**
     * Create a new Imagga API Client instance.
     *
     * @param HttpClient $client
     * @param string     $key
     * @param string     $secret
     */
    public function __construct(HttpClient $client, $key, $secret)
    {
        $this->client = $client;
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * Get a list of many automatically suggested textual tags.
     *
     * @param  string $url The image url.
     * @return array
     */
    public function tags($url, array $options = [])
    {
        return $this->send('GET', 'tagging', array_merge($options, [
            'url' => $url,
            'version' => '2',
        ]));
    }

    /**
     * Analyse and extract the predominant colors from one or several images.
     *
     * @param  string $url The image url.
     * @return array
     */
    public function extractColors($url, array $options = [])
    {
        return $this->send('GET', 'colors', array_merge($options, [
            'url' => $url,
        ]));
    }

    /**
     * Send the request to Imagga API.
     *
     * @param  string $method
     * @param  string $endpoint
     * @param  array $query
     * @return array
     */
    protected function send($method, $endpoint, $query)
    {
        $response = $this->client->request($method, $this->baseUrl . '/' . $endpoint, [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'auth' => [$this->key, $this->secret],
            'query' => $query,
        ]);

        return json_decode($response->getBody(), true);
    }
}
