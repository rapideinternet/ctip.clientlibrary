<?php

namespace Iza\Datacentralisatie;

use Iza\Datacentralisatie\Clients\AuthClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\FormatException;
use Iza\Datacentralisatie\Providers\ClientProvider;
use Iza\Datacentralisatie\RestClient\Response;

/**
 * Class DatacentralisatieClient
 * @package Iza\Datacentralisatie
 * @property-read \Iza\Datacentralisatie\Clients\ObjectClient $object
 * @property-read \Iza\Datacentralisatie\Clients\AuthClient $auth
 */
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
     * @var array
     */
    protected $userData;
    /**
     * @var string
     */
    protected $version = 'v1';
    /**
     * @var bool
     */
    protected $is_authenticated = false;
    /**
     * @var array
     */
    protected $clients = [];

    /**
     * DatacentralisatieClient constructor
     * @param $url
     * @param $credentials
     */
    public function __construct($url, $credentials = null) {
        $this->url = $url;
        $this->registerClients();
        if(!$credentials == null)
            $this->setCredentials($credentials);
    }

    /**
     * @return DatacentralisatieClient
     */
    public static function instance() {
        static $instance;

        if($instance instanceof self) {
            return $instance;
        }

        $instance = new self('');
        return $instance;
    }

    public function authenticate() {
        /** @var Response $response */
        $response = (new AuthClient($this))->login();

        if ($response->getInfo()->http_code == 200 && isset($response->getParsedResponse()->data->token)) {
            $this->is_authenticated = true;
            $this->token = $response->getParsedResponse()->data->token;
            $this->userData = [];
            $this->userData['email'] = $response->getParsedResponse()->data->email;
            $this->userData['name'] = $response->getParsedResponse()->data->name;
            $this->userData['user_id'] = $response->getParsedResponse()->data->user_id;
            $this->userData['tenant_id'] = $response->getParsedResponse()->data->tenant_id;
        }
        else {
            //todo this is crappy
            throw new Exception('Something went wrong during authentication');
        }
    }

    public function getToken() {
        return $this->token;
    }

    public function getUserData() {
        return $this->userData;
    }

    public function isAuthenticated() {
        if (!$this->is_authenticated) {
            $this->authenticate();
        }
    }

    public function registerClients() {
        $this->clients = (new ClientProvider())->clients();
    }

    public function getCredentials() {
        return $this->credentials;
    }

    /**
     * @param $credentials
     * @return $this
     * @throws FormatException
     */
    public function setCredentials($credentials)   {
        if(!isset($credentials[self::EMAIL])) {
            throw new FormatException('No email/username set');
        }

        if(!isset($credentials[self::PASSWORD])) {
            throw new FormatException('No password set');
        }

        $this->credentials = $credentials;
        return $this;
    }

    public function __call($method, $arguments) {
        if(!isset($this->clients[$method]) && !method_exists($this, $method)) {
            throw new \Exception("unknown method [$method]");
        }

        if(method_exists($this, $method)) {
            return call_user_func([$this, $method], $arguments);
        }

        $this->isAuthenticated();

        if(isset($this->clients[$method])) {
            //todo optimize with static storage?
            return new $this->clients[$method]($this);
        }
    }

    public function __get($property) {
        if(property_exists($this, $property)) {
            return $this->{$property};
        }

        $this->isAuthenticated();

        if(isset($this->clients[$property])) {
            //todo optimize with static storage?
            return new $this->clients[$property]($this);
        }
        throw new \Exception("unknown method [$property]");
    }

    public function getUrl() {
        return $this->url;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }
}
