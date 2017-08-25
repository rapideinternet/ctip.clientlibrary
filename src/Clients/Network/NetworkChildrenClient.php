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
     * @param array $include
     * @param bool $deleted_at
     * @return mixed
     */
    public function web($updated_at = 0, $include = [], $deleted_at = false)
    {
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('updated_at', $updated_at);
        $this->addParameter('deleted_at', $deleted_at);

        return $this->request(vsprintf('network/%s/children/web2', $this->selectedId));
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