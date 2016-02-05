<?php

namespace Iza\Datacentralisatie\Clients\Me;

use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class MeClient
 * @package Iza\Datacentralisatie\Clients\Me
 */
class MeClient extends BaseClient
{
    protected $object;

    public function me($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request('me', 'GET');
    }

    public function roles()
    {
        return $this->request('me/role', 'GET');
    }

    public function tenants()
    {
        return $this->request('me/tenant', 'GET');
    }

    public function getObject()
    {
        if (is_null($this->object)) {
            $this->object = $this->me();
        }

        return $this->object;
    }

    public function __get($parameter)
    {
        return $this->getObject()->{$parameter};
    }

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