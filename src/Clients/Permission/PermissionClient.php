<?php

namespace Iza\Datacentralisatie\Clients\Permission;

use Iza\Datacentralisatie\Clients\BaseClient;

class PermissionClient extends BaseClient
{
    public function all()
    {
        return $this->request('permission', 'GET');
    }
}