<?php

namespace Iza\Datacentralisatie\Clients\DynamicActionType;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class DynamicActionTypeClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    public function all($filter)
    {
        $this->addParameter('include', implode(',', $filter));
        $this->addParameter('perPage', $this->perPage);

        return $this->request('dynamic_action_type', 'GET');
    }

    public function byId($id)
    {
        return $this->request(vsprintf('dynamic_action_type/%s', $id), 'GET');
    }

    public function create($data)
    {
        return $this->request('dynamic_action_type', 'POST', json_encode($data))->getParsedResponse();
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        return new SelectedDynamicActionTypeClient($this->client, $offset);
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
