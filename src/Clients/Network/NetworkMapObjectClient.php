<?php

namespace Iza\Datacentralisatie\Clients\Network;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;
use Iza\Datacentralisatie\Traits\Sync;

/**
 * Class NetworkMapObjectClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class NetworkMapObjectClient extends NestedClient
{
    use PerPage, Sync;

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

        return $this->request(vsprintf('network/%s/map_object', $this->selectedId));
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

        return $this->request(vsprintf('network/%s/map_object', $this->selectedId), 'POST',
            $data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function delete($data)
    {
        return $this->request(vsprintf('network/%s/map_object', $this->selectedId), 'DELETE',
            $data);
    }

}