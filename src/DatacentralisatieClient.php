<?php

namespace Iza\Datacentralisatie;

use Iza\Datacentralisatie\Providers\ClientProvider;

class DatacentralisatieClient implements IDatacentralisatieClient
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $credentials;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $version = 'v1';

    protected $clients;

    /**
     * DatacentralisatieClient constructor
     * @param $url
     * @param $credentials
     */
    public function __construct($url, $credentials = [])
    {
        $this->url = $url;
        $this->registerClients();
        $this->credentials = $this->setCredentials($credentials);
    }

    public function authenticate()
    {

    }

    public function registerClients()
    {
        $this->clients = (new ClientProvider())->clients();
    }

    protected function setCredentials($credentials)
    {
        if (!isset($credentials[self::USERNAME])) {
            //throw exception
        }

        if (!isset($credentials[self::PASSWORD])) {
            //throw exception
        }

        $this->credentials = $credentials;
    }

    public function __call($method, $arguments)
    {
        if (!isset($this->clients[$method]) && !method_exists($this, $method)) {
            throw new \Exception("unknown method [$method]");
        }

        if (method_exists($this, $method)) {
            call_user_func([$this, $method], $arguments);
        }

        if (isset($this->clients[$method])) {
            //todo optimize with static storage?
            return new $this->clients[$method]($this);
        }
    }

    public function __get($property)
    {
        if (!isset($this->clients[$property]) && !property_exists($this, $property)) {
            throw new \Exception("unknown method [$property]");
        }

        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        if (isset($this->clients[$property])) {
            //todo optimize with static storage?
            return new $this->clients[$property]($this);
        }
    }

    public function __set($name, $value)
    {

    }

    public function getUrl()
    {
        return $this->url;
    }
}
