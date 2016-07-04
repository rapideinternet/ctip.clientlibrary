<?php

namespace Iza\Datacentralisatie\Clients\Tenant;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedTenantAuthorizationClient
 * @package Iza\Datacentralisatie\Clients\Role
 */
class SelectedTenantAuthorizationClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('tenant/%s/authorization/%s', $this->selectedId), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('tenant/%s/authorization/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('tenant/%s/authorization/%s', $this->selectedId), 'DELETE');
    }
}
