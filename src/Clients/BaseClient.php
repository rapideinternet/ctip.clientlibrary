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

    public function __construct(DatacentralisatieClient $client)
    {
        $this->client = $client;
        $this->restClient = RestClient::instance($client->getUrl());
    }

    public function newRequest($path, $method = 'GET', $data = null, $headers = [])
    {
        $response = $this->restClient->newRequest($this->formatUrl($path), $method, $data, $headers)->getResponse();
        return $this->parseResponse($response);
    }

    public function parseResponse($response)
    {
        //Run response through some kind of transformer to determine if it was good
        return $response;
    }

    public function formatUrl($path)
    {
        return sprintf('%s/%s', $this->client->version, $path);
    }
}
