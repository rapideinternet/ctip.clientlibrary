<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class MapObjectClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class MapObjectClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    /**
     * @param array $include
     * @param array $filter
     * @return mixed
     */
    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request('object', 'GET');
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s', $id), 'GET');
    }
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function deleted($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s/deleted', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->request('object', 'POST', $data);
    }

    /**
     * @param mixed $offset
     * @return bool|void
     * @throws NotImplementedException
     */
    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    /**
     * @param mixed $offset
     * @return SelectedMapObjectClient
     */
    public function offsetGet($offset)
    {
        return new SelectedMapObjectClient($this->client, $offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @throws NotImplementedException
     */
    public function offsetSet($offset, $value)
    {
        throw new NotImplementedException;
    }

    /**
     * @param mixed $offset
     * @throws NotImplementedException
     */
    public function offsetUnset($offset)
    {
        throw new NotImplementedException;
    }
}