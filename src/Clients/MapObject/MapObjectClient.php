<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class MapObjectClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);
		$this->addParameter('page', $this->page);

        return $this->request('object', 'GET');
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s', $id), 'GET');
    }

    public function create($data)
    {
        return $this->request('object', 'POST', $data)->getParsedResponse();
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        return new SelectedMapObjectClient($this->client, $offset);
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