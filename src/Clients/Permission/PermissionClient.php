<?php

namespace Iza\Datacentralisatie\Clients\Permission;

use Iza\Datacentralisatie\Clients\BaseClient;

/**
 * Class PermissionClient
 * @package Iza\Datacentralisatie\Clients\Permission
 */
class PermissionClient extends BaseClient
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->request('permission', 'GET');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return $this->request(vsprintf('permission/%s', $id), 'GET');
    }

}