<?php namespace Iza\Datacentralisatie;

/**
 * Class BaseRequest
 * @package Iza\Datacentralisatie
 */
abstract class BaseRequest implements IBaseRequest
{
    private $client;

    /**
     * @param DatacentralisatieClient $client
     */
    public function __construct(DatacentralisatieClient $client)
    {
        $this->client = $client;
    }

    public function test()
    {

    }

    abstract function getMethod();

    abstract function getPath();

    abstract function getParameters();

    abstract function getBodySchema();
}