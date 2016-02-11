<?php

namespace Iza\Datacentralisatie\Clients\User;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class UserClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    public function all($filter = [])
    {
        $this->addParameter('include', implode(',', $filter));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request('user', 'GET');
    }

    public function byId($id)
    {
        return $this->request(vsprintf('user/%s', $id), 'GET');
    }

    public function create($data)
    {
        return $this->request('user', 'POST', $data)->getParsedResponse();
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        return new SelectedUserClient($this->client, $offset);
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