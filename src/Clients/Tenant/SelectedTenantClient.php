<?php

namespace Iza\Datacentralisatie\Clients\Tenant;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedTenantClient
 * @package Iza\Datacentralisatie\Clients\Tenant
 */
class SelectedTenantClient extends NestedClient
{
    protected $nestedObjects = [
        'authorization' => \Iza\Datacentralisatie\Clients\Tenant\TenantAuthorizationClient::class,
        'network' => \Iza\Datacentralisatie\Clients\Tenant\TenantNetworkClient::class,
        'user' => \Iza\Datacentralisatie\Clients\Tenant\TenantUserClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('tenant/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('tenant/%s', $this->selectedId), 'PATCH', $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('tenant/%s', $this->selectedId), 'DELETE');
    }
}