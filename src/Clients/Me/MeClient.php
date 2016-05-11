<?php

namespace Iza\Datacentralisatie\Clients\Me;

use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class MeClient
 * @package Iza\Datacentralisatie\Clients\Me
 */
class MeClient extends BaseClient
{
    protected $object;

    /**
     * @param array $include
     * @return mixed
     */
    public function me($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request('me', 'GET');
    }

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->request('me/role', 'GET');
    }

    /**
     * @return mixed
     */
    public function tenants()
    {
        return $this->request('me/tenant', 'GET');
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        if (is_null($this->object)) {
            $this->object = $this->me();
        }

        return $this->object;
    }

    /**
     * @param $parameter
     * @return mixed
     */
    public function __get($parameter)
    {
        return $this->getObject()->{$parameter};
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

        $this->getObject();

        if (method_exists($this->object, $method)) {
            return call_user_func([$this->object, $method], $arguments);
        }

        throw new Exception('Function not found');
    }
}