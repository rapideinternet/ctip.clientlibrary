<?php

namespace Iza\Datacentralisatie\Clients\Role;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedRoleClient extends NestedClient
{
    protected $nestedObjects = [
        'permissions' => \Iza\Datacentralisatie\Clients\Role\RolePermissionsClient::class,
    ];

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('role/%s', $id), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('role/%s', $this->selectedId), 'PATCH', $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('role/%s', $this->selectedId), 'DELETE', $data);
    }
}
