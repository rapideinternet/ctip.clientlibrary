<?php

namespace Iza\Datacentralisatie\Clients\MapObjectType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\Sync;

/**
 * Class MapObjectTypeSettingClient
 * @package Iza\Datacentralisatie\Clients\MapObjectType
 */
class MapObjectTypeSettingClient extends NestedClient
{
    use Sync;

    /**
     * @param array $include
     * @param array $filter
     * @return mixed
     */
    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('type/%s/setting', $this->selectedId));
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

        return $this->request(vsprintf('type/%s/setting', $this->selectedId), 'POST',
            $data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function delete($data)
    {
        return $this->request(vsprintf('type/%s/setting', $this->selectedId), 'DELETE',
            $data);
    }

}