<?php

namespace Iza\Datacentralisatie\Clients;

use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class NestedClient
 * @package Iza\Datacentralisatie\Clients
 */
abstract class NestedClient extends BaseClient
{
    protected $selectedId = [];

    protected $object = null;

    protected $nestedObjects = [];

    /**
     * @param DatacentralisatieClient $client
     * @param $id
     */
    public function __construct(DatacentralisatieClient $client, $id)
    {
        parent::__construct($client);

        $this->setSelectedIds($id);
    }

    /**
     * @param $ids
     */
    public function setSelectedIds($ids)
    {
        if (is_array($ids)) {
            foreach ($ids as $id) {
                $this->selectedId[] = $id;
            }
        }

        if (is_int($ids) || is_string($ids)) {
            $this->selectedId[0] = $ids;
        }
    }

    public function validateNestedClient()
    {
        if (empty($this->selectedId)) {
            throw new Exception('No selected id/id\'s');
        }
    }

    /**
     * @return mixed|null
     */
    public function getObject()
    {
        if (is_null($this->object)) {
            $this->object = $this->byId($this->selectedId);
        }

        return $this->object;
    }

    /**
     * @param $parameter
     * @return mixed
     */
    public function __get($parameter)
    {
        //TODO maybe confusing

        if (isset($this->nestedObjects[$parameter])) {
            return new $this->nestedObjects[$parameter]($this->client, $this->selectedId);
        }

        return $this->getObject()->{$parameter};
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getObject();
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return call_user_func([$this, $method], $arguments);
        }

        $this->validateNestedClient();
        $this->getObject();

        if (method_exists($this->object, $method)) {
            return call_user_func([$this->object, $method], $arguments);
        }

    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public abstract function byId($id, $include = []);
}