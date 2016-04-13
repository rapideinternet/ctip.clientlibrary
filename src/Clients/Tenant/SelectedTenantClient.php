<?php

namespace Iza\Datacentralisatie\Clients\Tenant;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedTenantClient extends NestedClient
{
    protected $nestedObjects = [
        'user' => \Iza\Datacentralisatie\Clients\Tenant\TenantUserClient::class,
    ];

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('tenant/%s', $id), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('tenant/%s', $this->selectedId), 'PATCH', $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('tenant/%s', $this->selectedId), 'DELETE', $data);
    }
}