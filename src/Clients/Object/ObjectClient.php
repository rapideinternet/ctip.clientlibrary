<?php

namespace Iza\Datacentralisatie\Clients;

use ArrayAccess;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class ObjectClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    public function all($filter)
    {
        $this->addParameter('include', implode(',', $filter));
        $this->addParameter('perPage', $this->perPage);

        return $this->request('object', 'GET');
    }

    public function byId($id)
    {
        return $this->request(vsprintf('object/%s', $id), 'GET');
    }

    public function offsetExists($offset)
    {
        return "exists";
    }

    public function offsetGet($offset)
    {
        return new SelectedObjectClient($this->client, $offset);
    }

    public function offsetSet($offset, $value)
    {
        //
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}