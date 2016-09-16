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
    protected $credentials = [
        self::USERNAME => null,
        self::PASSWORD => null,
        self::TOKEN => null,
        self::CLIENT_ID => null,
        self::CLIENT_SECRET => null,
        self::EXPIRE_TIME => null,
        self::EXPIRE_THRESHOLD => 600
    ];

    /**
     * @var string
     */
    protected $version = 'v1';
    /**
     * @var bool
     */
    protected $is_authenticated = false;

    /**
     * @var bool
     */
    protected $use_refresh = false;

    /**
     * @var int
     */
    protected $refresh_counter = 0;

    /**
     * @var int
     */
    public $refresh_tries = 1;

    /**
     * @var array
     */
    protected $clients = [];

    protected $callback = null;

    /**
     * DatacentralisatieClient constructor
     * @param $url
     * @param $credentials
     */
    public function __construct($url, $credentials = null)
    {
        $this->url = $url;
        $this->registerClients();
        if (!$credentials == null) {
            $this->setCredentials($credentials);
        }
    }

    /**
     * @return DatacentralisatieClient
     */
    public static function instance()
    {
        static $instance;

        if ($instance instanceof self) {
            return $instance;
        }

        $instance = new self('');

        return $instance;
    }

    public function authenticate()
    {
        /** @var Response $response */
        $response = (new AuthClient($this))->login();

        $this->authRequest($response);
    }

    public function refresh()
    {
        /** @var Response $response */
        $response = (new AuthClient($this))->refresh();

        $this->authRequest($response);
        $this->fireCallback();
    }

    public function fireCallback()
    {
        if (is_callable($this->callback)) {
            call_user_func([$this, $this->callback], [$this]);
        }
    }

    public function setRefreshCallback($next)
    {
        $this->callback = $next;
    }

    public function handleError($data)
    {
        switch ($data->error) {
            case 'access_denied':
                if ($this->use_refresh && ($this->refresh_counter < $this->refresh_tries)) {
                    $this->refresh_counter++;
                    $this->refresh();
                    return;
                }
                break;
        }

        throw new Exception($data->error_description);
    }

    public function authRequest(Response $response)
    {
        if ($response->getInfo()->http_code == 200 && isset($response->getParsedResponse()->access_token)) {

            $this->setToken($response->getParsedResponse()->access_token);

            if (isset($response->getParsedResponse()->refresh_token)) {
                $this->setRefreshToken($response->getParsedResponse()->refresh_token);
            }

            $this->setExpired($response->getParsedResponse()->expires_in);
        } else {
            if ($response->getInfo()->http_code >= 300 && isset($response->getParsedResponse()->error)) {
                $this->handleError($response->getParsedResponse());
            }

            throw new Exception('Received an invalid response');
        }

    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->getCredentials()[self::TOKEN];
    }

    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->getCredentials()[self::REFRESH_TOKEN];
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->credentials[self::TOKEN] = $token;
        $this->is_authenticated = true;
    }

    /**
     * @return null|int
     */
    public function getExpired()
    {
        return $this->credentials[self::EXPIRE_TIME];
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        if (is_null($this->credentials[self::EXPIRE_TIME])) {
            return true;
        }

        return time() > ($this->credentials[self::EXPIRE_TIME] - $this->credentials[self::EXPIRE_THRESHOLD]);
    }

    /**
     * @param $expired int Expiration time in seconds
     */
    public function setExpired($expired)
    {
        $this->credentials[self::EXPIRE_TIME] = time() + $expired;
    }

    /**
     * @return int
     */
    public function getExpireThreshold()
    {
        return $this->credentials[self::EXPIRE_THRESHOLD];
    }

    /**
     * @param $threshold int Set expire threshold before refreshing
     */
    public function setExprieThreshold($threshold)
    {
        $this->credentials[self::EXPIRE_THRESHOLD] = $threshold;
    }

    /**
     * @param $token
     */
    public function setRefreshToken($refreshToken)
    {
        $this->credentials[self::REFRESH_TOKEN] = $refreshToken;
        $this->use_refresh = true;
    }

    public function isAuthenticated()
    {
        if (!$this->is_authenticated) {
            $this->authenticate();
        }
    }

    public function registerClients()
    {
        $this->clients = (new ClientProvider())->clients();
    }

    /**
     * @return array
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @param $credentials
     * @return $this
     * @throws FormatException
     */
    public function setCredentials($credentials)
    {
        $this->credentials = array_merge($this->credentials, $credentials);

        if (!isset($credentials[self::CLIENT_ID])) {
            throw new FormatException('No oauth client id set');
        }

        if (!isset($credentials[self::CLIENT_SECRET])) {
            throw new FormatException('No oauth client secret set');
        }

        if (!isset($credentials[self::TOKEN])) {
            if (!isset($credentials[self::USERNAME])) {
                throw new FormatException('No email/username set');
            }

            if (!isset($credentials[self::PASSWORD])) {
                throw new FormatException('No password set');
            }
        } else {
            $this->setToken($credentials[self::TOKEN]);
        }

        return $this;
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $arguments)
    {
        if (!isset($this->clients[$method]) && !method_exists($this, $method)) {
            throw new \Exception("unknown method [$method]");
        }

        if (method_exists($this, $method)) {
            return call_user_func([$this, $method], $arguments);
        }

        $this->isAuthenticated();

        if (isset($this->clients[$method])) {
            //todo optimize with static storage?
            return new $this->clients[$method]($this);
        }
    }

    /**
     * @param $property
     * @return mixed
     * @throws \Exception
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        $this->isAuthenticated();

        if (isset($this->clients[$property])) {
            //todo optimize with static storage?
            return new $this->clients[$property]($this);
        }
        throw new \Exception("unknown method [$property]");
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
