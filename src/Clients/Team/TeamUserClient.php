<?php

namespace Iza\Datacentralisatie\Clients\Team;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class TeamUserClient
 * @package Iza\Datacentralisatie\Clients\Tenant
 */
class TeamUserClient extends NestedClient
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

        return $this->request(vsprintf('team/%s/user', $this->selectedId));
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
        return $this->request(vsprintf('team/%s/user', $this->selectedId), 'POST',
            $data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function delete($data)
    {
        return $this->request(vsprintf('team/%s/user', $this->selectedId), 'DELETE',
            $data);
    }
}