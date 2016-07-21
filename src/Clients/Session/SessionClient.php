<?php

namespace Iza\Datacentralisatie\Clients\Session;

use Iza\Datacentralisatie\Clients\BaseClient;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class SessionClient
 * @package Iza\Datacentralisatie\Clients\Role
 */
class SessionClient extends BaseClient
{
    use PerPage;

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function tenant($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request('session/tenant', 'GET');
    }
}