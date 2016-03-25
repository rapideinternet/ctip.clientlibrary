<?php

namespace Iza\Datacentralisatie\Clients;

use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\RestClient\RestClient;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    public function request($path, $method = 'GET', $data = null, $headers = [], $isJson = true)
    {
        $response = $this->restClient->newRequest($this->formatUrl($path), $method, $data,
            array_merge($this->getDefaultHeaders(), $headers), $isJson)->getResponse();

        return $this->parseResponse($response);
    }

    public function fileRequest($path, UploadedFile $file)
    {
        $data = array(
            'image' => new \CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName())
        );
        $headers = array("Content-Type" => "multipart/form-data");

        return $this->request($path, 'POST', $data, $headers, false);
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
