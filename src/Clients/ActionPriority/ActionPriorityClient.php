<?php

namespace Iza\Datacentralisatie\Clients\ActionPriority;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class ActionPriorityClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    public function all($filter)
    {
        $this->addParameter('include', implode(',', $filter));
        $this->addParameter('perPage', $this->perPage);

        return $this->request('action_status', 'GET');
    }

    public function byId($id)
    {
        return $this->request(vsprintf('action_priority/%s', $id), 'GET');
    }

    public function create($data)
    {
        return $this->request('action_priority', 'POST', $data)->getParsedResponse();
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        return new SelectedActionPriorityClient($this->client, $offset);
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
