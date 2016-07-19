<?php

namespace Iza\Datacentralisatie\Clients\Role;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedRoleClient
 * @package Iza\Datacentralisatie\Clients\Role
 */
class SelectedRoleClient extends NestedClient
{
    protected $nestedObjects = [
        'actionStatus' => \Iza\Datacentralisatie\Clients\Role\RoleActionStatusClient::class,
        'permission' => \Iza\Datacentralisatie\Clients\Role\RolePermissionsClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('role/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('role/%s', $this->selectedId), 'PATCH', $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('role/%s', $this->selectedId), 'DELETE');
    }
}
