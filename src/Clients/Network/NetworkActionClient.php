<?php

namespace Iza\Datacentralisatie\Clients\Network;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;
use Iza\Datacentralisatie\Traits\Sort;

/**
 * Class NetworkActionClient
 * @package Iza\Datacentralisatie\Clients\Network
 */
class NetworkActionClient extends NestedClient
{
    use PerPage, Sort;

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
        $this->addParameter('sort', $this->sort);

        return $this->request(vsprintf('network/%s/action', $this->selectedId));
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

        return $this->request(vsprintf('network/%s/action/web', $this->selectedId));
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
