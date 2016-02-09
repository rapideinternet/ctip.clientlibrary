<?php

namespace Iza\Datacentralisatie\Clients\Tenant;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class TenantClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    public function all($filter)
    {
        $this->addParameter('include', implode(',', $filter));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request('tenant', 'GET');
    }

    public function byId($id)
    {
        return $this->request(vsprintf('tenant/%s', $id), 'GET');
    }

    public function create($data)
    {
        return $this->request('tenant', 'POST', $data)->getParsedResponse();
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        return new SelectedTenantClient($this->client, $offset);
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