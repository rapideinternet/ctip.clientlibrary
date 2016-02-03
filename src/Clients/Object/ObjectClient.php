<?php

namespace Iza\Datacentralisatie\Clients\Object;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
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

    public function create($data)
    {
        return $this->request('object', 'POST', $data);
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        return new SelectedObjectClient($this->client, $offset);
    }

    public function offsetSet($offset, $value)
    {
        throw new NotImplementedException;
    }

    public function offsetUnset($offset)
    {
        throw new NotImplementedException;
    }
}