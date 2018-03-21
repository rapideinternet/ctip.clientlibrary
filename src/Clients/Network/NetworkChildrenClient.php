<?php

namespace Iza\Datacentralisatie\Clients\Network;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\Depth;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class NetworkChildrenClient
 * @package Iza\Datacentralisatie\Clients\Network
 */
class NetworkChildrenClient extends NestedClient
{
    use PerPage, Depth;

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
        $this->addParameter('depth', $this->depth);

        return $this->request(vsprintf('network/%s/children', $this->selectedId));
    }

    /**
     * @param int $updated_at
     * @param array $filter
     * @param bool $deleted_at
     * @return mixed
     */
    public function web($updated_at = 0, $filter = [], $deleted_at = false)
    {
        $this->addFilters($filter);
        $this->addParameter('updated_at', $updated_at);
        $this->addParameter('deleted_at', $deleted_at);

        return $this->request(vsprintf('network/%s/children/web2', $this->selectedId));
    }

    /**
     * @param int $map_object_type_id
     * @param int $updated_at
     * @param bool $deleted_at
     * @return mixed
     */
    public function findByType($map_object_type_id = 0, $updated_at = 0, $deleted_at = false)
    {
        $this->addParameter('updated_at', $updated_at);
        $this->addParameter('deleted_at', $deleted_at);

        array_push($this->selectedId, $map_object_type_id);

        return $this->request(vsprintf('network/%s/children/type/%s', $this->selectedId));
    }

    /**
     * @param $data
     * @param array $include
     * @return mixed
     */
    public function find($data, $include = [])
    {
        $this->addParameter('include', implode(',', $include));
        return $this->request(vsprintf('network/%s/children/find', $this->selectedId), 'POST', $data);
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
}