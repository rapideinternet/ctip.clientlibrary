<?php

namespace Iza\Datacentralisatie\Clients\KeyValue;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class KeyValueClient
 * @package Iza\Datacentralisatie\Clients\KeyValue
 */
class KeyValueClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->request('kv', 'GET');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return $this->request(vsprintf('kv/%s', $id), 'GET');
    }

    /**
     * @param $id
     * @param $value
     * @return mixed
     */
    public function create($id, $value)
    {
        return $this->request(vsprintf('kv/%s', $id), 'POST', $value);
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
     * @return SelectedKeyValueClient
     */
    public function offsetGet($offset)
    {
        return new SelectedKeyValueClient($this->client, $offset);
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
