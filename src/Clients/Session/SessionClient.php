<?php

namespace Iza\Datacentralisatie\Clients\Role;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class SessionClient
 * @package Iza\Datacentralisatie\Clients\Role
 */
class SessionClient extends BaseClient implements ArrayAccess
{
    use PerPage;

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('session/%s', $id), 'GET');
    }
}