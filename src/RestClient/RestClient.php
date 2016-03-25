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
     * @param bool $isJson
     * @return IRequest
     */
    public function newRequest($url, $method = 'GET', $data = null, $headers = [], $isJson = true)
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
            $request->setOption(self::DATA_KEY, ($isJson ? json_encode($data) : $data));
        }

        // headers
        if (!empty($headers)) {
            $request->setOption(self::HEADERS_KEY, $headers);
        }

        return $request;

    }

    /**
     * @param IRequest $request
     * @param $filesize
     * @param $postfields
     * @return mixed
     */
    public function makeFileRequest($url, $method = 'GET', $data = null, $headers = [], $filesize, $postfields)
    {

        //dd($url);
        $baseUrl = rtrim($this->request->getOption(self::BASE_URL_KEY, ''), '/');
        if ('' != $baseUrl) {
            $url = sprintf("%s/%s", $baseUrl, ltrim($url, '/'));
        }
        $url .= "token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0bnQiOiIxIiwic3ViIjoxLCJpc3MiOiJodHRwOlwvXC9ob21lc3RlYWQuYXBwXC92MVwvYXV0aCIsImlhdCI6MTQ1ODgzNjEwNiwiZXhwIjoxNDU4OTIyNTA2LCJuYmYiOjE0NTg4MzYxMDYsImp0aSI6IjhjZDJjMWZmNTlmNzc3MjA1YWYzOGZmZjkwNThiYjgwIn0.Ft1y6DJwqdeH5kkrqDio4y9RfF2oWb8A3DohYcwPr9o";
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => true,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $postfields,
            //CURLOPT_INFILESIZE => $filesize,
            CURLOPT_RETURNTRANSFER => true
        ); // cURL options
        curl_setopt_array($ch, $options);
        dd($options);
        echo(curl_exec($ch));


        if (!curl_errno($ch)) {
            $info = curl_getinfo($ch);
            dd($info);
            if ($info['http_code'] == 200) {
                $errmsg = "File uploaded successfully";
            }
        } else {
            $errmsg = curl_error($ch);
            dd($errmsg);
        }
        curl_close($ch);
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
            $request->setOption(self::DATA_KEY, json_encode($data));
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
