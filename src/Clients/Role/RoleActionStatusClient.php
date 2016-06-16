<?php

namespace Iza\Datacentralisatie\Clients\Role;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class RoleActionStatusClient
 * @package Iza\Datacentralisatie\Clients\Role
 */
class RoleActionStatusClient extends NestedClient
{
    use PerPage;

    /**
     * @param array $include
     * @param array $filter
     * @return mixed
     */
    function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request(vsprintf('role/%s/action_status', $this->selectedId));
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
        return $this->request(vsprintf('role/%s/action_status', $this->selectedId), 'POST',
            $data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('role/%s/action_status', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function delete($data)
    {
        return $this->request(vsprintf('role/%s/action_status', $this->selectedId), 'DELETE',
            $data);
    }

}
