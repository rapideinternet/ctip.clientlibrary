<?php

namespace Iza\Datacentralisatie\Clients;

use ArrayAccess;

class ObjectClient extends BaseClient implements ArrayAccess
{
    protected $perPage = 15;

    public function setPerPage($perPage)
    {
        return $this->perPage = $perPage;
    }

    public function all($filter)
    {
        return 'all';
    }

    public function byId($id)
    {
        return $this->newRequest(sprintf('object/%s', $id), 'GET');
    }

    public function offsetExists($offset)
    {
        return "exists";
    }

    public function offsetGet($offset)
    {
        return $this->byId($offset);
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}