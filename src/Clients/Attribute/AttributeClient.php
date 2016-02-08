<?php

namespace Iza\Datacentralisatie\Clients\Attribute;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class AttributeClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);

        return $this->request('attribute', 'GET');
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('attribute/%s', $id), 'GET');
    }

    public function create($data)
    {
        return $this->request('attribute', 'POST', $data);
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        return new SelectedAttributeClient($this->client, $offset);
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