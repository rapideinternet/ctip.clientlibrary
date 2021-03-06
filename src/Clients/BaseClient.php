<?php

namespace Iza\Datacentralisatie\Clients;

use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\RestClient\RestClient;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class BaseClient
 * @package Iza\Datacentralisatie\Clients
 */
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
     * @var array
     */
    protected $parameters = [];

    /**
     * @var bool
     */
    protected $raw = false;

    /**
     * @param DatacentralisatieClient $client
     */
    public function __construct(DatacentralisatieClient $client)
    {
        $this->client = $client;
        $this->restClient = RestClient::instance($client->getUrl());
    }

    /**
     *
     */
    private function beforeRequest()
    {
        if ($this->raw) {
            return;
        }

        if ($this->client->isExpired()) {
            $this->client->refresh();
        }
    }

//    public function setTenantId($tenant_id)
//    {
//        if(is_int($tenant_id)) {
//            $this->client->setTenantId($tenant_id);
//        }
//
//        return $this;
//    }
//
//    public function setNetworkId($network_id)
//    {
//        if(is_int($network_id)) {
//            $this->client->setNetworkId($network_id);
//        }
//
//        return $this;
//    }

    /**
     * @param $path
     * @param string $method
     * @param null $data
     * @param array $headers
     * @param bool $isJson
     * @param null|string $version
     * @return mixed
     */
    public function request($path, $method = 'GET', $data = null, $headers = [], $isJson = true, $version = null)
    {
        $this->beforeRequest();
        $response = $this->restClient->newRequest($this->formatUrl($path, $version), $method, $data,
            array_merge($this->getDefaultHeaders(), $headers), $isJson)->getResponse();

        return $this->parseResponse($response);
    }

    /**
     * @param $path
     * @param UploadedFile $file
     * @param $data
     * @return mixed
     */
    public function fileRequest($path, UploadedFile $file, $data)
    {
        $this->beforeRequest();
        $formData = [
            'image' => new \CURLFile($file->getRealPath(), $file->getMimeType(), $file->getFilename())
        ];
        $formData = array_merge($formData, $data);
        $headers = ["Content-Type" => "multipart/form-data"];

        return $this->request($path, 'POST', $formData, $headers, false);
    }


    /**
     * @param $path
     * @param UploadedFile $file
     * @return mixed
     */
    public function binaryRequest($path, UploadedFile $file)
    {
        $this->beforeRequest();
        $formData = file_get_contents($file->getRealPath());
        $headers = ["Content-Type" => "application/json"];

        return $this->request($path, 'POST', $formData, $headers, false);
    }

    /**
     * @return array
     */
    protected function getDefaultHeaders()
    {
        $defaultHeaders = [
            'Authorization' => sprintf('Bearer %s', $this->client->getToken()),
            'Content-Type' => 'application/json'
        ];

//        if($this->client->getTenantId() > 0) {
//            $defaultHeaders['x-tenant'] = $this->client->getTenantId();
//        }
//
//        if($this->client->getNetworkId() > 0) {
//            $defaultHeaders['x-network'] = $this->client->getNetworkId();
//        }

        return $defaultHeaders;
    }

    /**
     * @param $response
     * @return mixed
     */
    public function parseResponse($response)
    {
        //Run response through some kind of transformer to determine if it was good
        return $response;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * @param array $filters
     */
    public function addFilters(array $filters)
    {
        foreach ($filters as $key => $value) {
            $this->addParameter($key, $value);
        }
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->getParameters();
    }

    /**
     * @param $path
     * @param null $version
     * @return string
     */
    public function formatUrl($path, $version = null)
    {
        foreach ($this->parameters as $key => $value) {
            if (is_array($value)) {
                $parameters[$key] = '(' . implode(',', $value) . ')';
            }
        }

        $parameter_string = http_build_query($this->parameters);

        if($version !== null) {
            return sprintf('%s/%s?%s', $version, ltrim($path, '/'), $parameter_string);
        }

        return sprintf('%s/%s?%s', $this->client->version, ltrim($path, '/'), $parameter_string);
    }

    /**
     * @return BaseClient
     */
    public function setRaw()
    {
        $this->raw = true;
        return $this;
    }
}
