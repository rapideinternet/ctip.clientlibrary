<?php

namespace Iza\Datacentralisatie\Clients\Session;

use Iza\Datacentralisatie\Clients\BaseClient;

/**
 * Class SessionClient
 * @package Iza\Datacentralisatie\Clients\Role
 */
class SessionClient extends BaseClient
{
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

    public function setTenant($tenantId)
    {
        return $this->request(sprintf('session/tenant/%d', $tenantId), 'POST');
    }
}