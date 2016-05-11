<?php

namespace Iza\Datacentralisatie\Clients\Role;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedRolePermissionsClient
 * @package Iza\Datacentralisatie\Clients\Role
 */
class SelectedRolePermissionsClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('role/%s/permissions/%s', $this->selectedId), 'GET');
    }
}
