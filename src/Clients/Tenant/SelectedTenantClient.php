<?php

namespace Iza\Datacentralisatie\Clients\Tenant;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedTenantClient extends NestedClient
{
    use PerPage;

    protected $nestedTenants = [
        'children' => \Iza\Datacentralisatie\Clients\Tenant\ChildrenTenantClient::class
    ];

    public function update($data)
    {
        return $this->request(vsprintf('tenant/%s', $this->selectedIds), 'PATCH', $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('tenant/%s', $this->selectedIds), 'DELETE', $data);
    }

    public function byId($id)
    {
        return $this->request(vsprintf('tenant/%s', $id), 'GET');
    }
}