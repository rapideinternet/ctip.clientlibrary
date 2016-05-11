<?php

namespace Iza\Datacentralisatie\Clients\Action;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class ActionClient
 * @package Iza\Datacentralisatie\Clients\Action
 */
class ActionClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    /**
     * @param $filter
     * @return mixed
     */
    public function all($filter)
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $filter));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request('action', 'GET');
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('action/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->request('action', 'POST', $data);
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
     * @return SelectedActionClient
     */
    public function offsetGet($offset)
    {
        return new SelectedActionClient($this->client, $offset);
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
