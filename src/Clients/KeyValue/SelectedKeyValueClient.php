<?php

namespace Iza\Datacentralisatie\Clients\KeyValue;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedKeyValueClient
 * @package Iza\Datacentralisatie\Clients\KeyValue
 */
class SelectedKeyValueClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        return $this->request(vsprintf('kv/%s', $id), 'GET');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function create($value)
    {
        return $this->request(vsprintf('kv/%s', $this->selectedId), 'POST', $value);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('kv/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('kv/%s', $this->selectedId), 'DELETE');
    }
}
