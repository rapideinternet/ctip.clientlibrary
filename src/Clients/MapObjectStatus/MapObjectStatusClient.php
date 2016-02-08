<?php

namespace Iza\Datacentralisatie\Clients\MapObjectStatus;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class MapObjectStatusClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    public function all($filter)
    {
        $this->addParameter('include', implode(',', $filter));
        $this->addParameter('perPage', $this->perPage);

        return $this->request('map_object_status', 'GET');
    }

    public function byId($id)
    {
        return $this->request(vsprintf('map_object_status/%s', $id), 'GET');
    }

    public function create($data)
    {
        return $this->request('map_object_status', 'POST', $data)->getParsedResponse();
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        return new SelectedMapObjectStatusClient($this->client, $offset);
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
