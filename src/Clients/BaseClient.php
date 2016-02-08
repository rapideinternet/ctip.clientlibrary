<?php

namespace Iza\Datacentralisatie\Clients;

use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\RestClient\RestClient;

abstract class BaseClient
{
    /**
     * @var DatacentralisatieClient
     */
    protected $client;
    /**
     * @var RestClient
     */
    protected $restClient;
    /**
     * @var string
     */
    protected $parameters = [];

    public function __construct(DatacentralisatieClient $client)
    {
        $this->client = $client;
        $this->restClient = RestClient::instance($client->getUrl());
    }

    public function request($path, $method = 'GET', $data = null, $headers = [])
    {
        $response = $this->restClient->newRequest($this->formatUrl($path), $method, $data,
            array_merge($headers, $this->getDefaultHeaders()))->getResponse();

        return $this->parseResponse($response);
    }

    protected function getDefaultHeaders()
    {
        return [
            'Authorization' => sprintf('Bearer %s', $this->client->getToken()),
            'Content-Type' => 'application/json'
        ];
    }

    public function parseResponse($response)
    {
        //Run response through some kind of transformer to determine if it was good
        return $response;
    }

    public function addParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    public function addFilters(array $filters)
    {
        foreach ($filters as $key => $value) {
            $this->addParameter($key, $value);
        }
    }

    public function getParameters()
    {
        return $this->getParameters();
    }

    public function formatUrl($path)
    {
        $parameter_string = http_build_query($this->parameters);

        return sprintf('%s/%s?%s', $this->client->version, ltrim($path, '/'), $parameter_string);
    }
}
