<?php

namespace Iza\Datacentralisatie\Clients\Tenant;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedTenantClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'users' => \Iza\Datacentralisatie\Clients\Tenant\TenantUserClient::class,
    ];

    public function byId($id)
    {
        return $this->request(vsprintf('tenant/%s', $id), 'GET');
    }
}