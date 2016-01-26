<?php

namespace Iza\Datacentralisatie\RestClient;

/**
 * Class RestClient
 * @package Iza\Datacentralisatie\RestClient
 */
class RestClient implements IRestClient
{

    private $request;

    /**
     * @param array $config
     */
    public function __construct($config = [])
    {
        if (is_string($config)) {
            $config = [self::BASE_URL_KEY => $config];
        }
        $this->request = new Request($config);
    }

    /*
     * ========== IRequest ==========
     */
    /**
     * @param string $url
     * @param string $method
     * @param string $data
     * @param array $headers
     * @return IRequest
     */
    public function newRequest($url, $method = 'GET', $data = null, $headers = [])
    {

        // clone request
        $request = clone $this->request;

        // configure URL
        $baseUrl = rtrim($this->request->getOption(self::BASE_URL_KEY, ''), '/');
        if ('' != $baseUrl) {
            $url = sprintf("%s/%s", $baseUrl, ltrim($url, '/'));
        }
        $request->setOption(self::BASE_URL_KEY, $url);

        // method
        $request->setOption(self::METHOD_KEY, $method);

        // data
        if ((!is_null($data)) && (!empty($data))) {
            $request->setOption(self::DATA_KEY, $data);
        }

        // headers
        if (!empty($headers)) {
            $request->setOption(self::HEADERS_KEY, $headers);
        }

        return $request;

    }

    /**
     * Get the configuration key of the client (request).
     *
     * @param string $key
     * @param mixed $default Default value to return if no value is set.
     * @return mixed Config value.
     */
    public function getOption($key, $default = null)
    {
        return $this->request->getOption($key, $default);
    }

    /**
     * Set configuration parameter.
     *
     * @param string $key Configuration key
     * @param string $value Value
     */
    public function setOption($key, $value)
    {
        $this->request->setOption($key, $value);
    }

    /**
     * Merge the current configuration array with the $config array provided.
     *
     * @param array $config Configuration array to be merged with the current configuration.
     * @return array Current configuration array after the merge.
     */
    public function setConfig($config)
    {
        return $this->request->setConfig($config);
    }

    /**
     * @return RestClient
     */
    public static function instance($config = [])
    {
        static $instance = null;

        if (!is_null($instance)) {
            return $instance;
        }

        return $instance = new self($config);
    }

}
