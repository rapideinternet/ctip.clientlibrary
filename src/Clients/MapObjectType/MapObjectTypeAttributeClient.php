<?php

namespace Iza\Datacentralisatie\Clients\MapObjectType;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\DefaultAttribute;
use Iza\Datacentralisatie\Traits\Sync;

/**
 * Class MapObjectTypeAttributeClient
 * @package Iza\Datacentralisatie\Clients\MapObjectType
 */
class MapObjectTypeAttributeClient extends NestedClient implements ArrayAccess
{
    use Sync, DefaultAttribute;

    /**
     * @param array $include
     * @param array $filter
     * @return mixed
     */
    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('type/%s/attribute', $this->selectedId));
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        return $this->all($include);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        if ($this->sync) {
            $this->addParameter('sync', $this->sync);
        }

        return $this->request(vsprintf('type/%s/attribute', $this->selectedId), 'POST',
            $data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function delete($data)
    {
        return $this->request(vsprintf('type/%s/attribute', $this->selectedId), 'DELETE',
            $data);
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
     * @return SelectedMapObjectTypeAttributeClient
     */
    public function offsetGet($offset)
    {
        array_push($this->selectedId, $offset);

        return new SelectedMapObjectTypeAttributeClient($this->client, $this->selectedId);
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