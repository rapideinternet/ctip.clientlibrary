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
     * @param array $include
     * @return mixed
     */
    public function tenant($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request('session/tenant', 'GET');
    }

    /**
     * @param $tenantId
     * @return mixed
     */
    public function setTenant($tenantId)
    {
        return $this->setTenantId($tenantId);
//        return $this->request(sprintf('session/tenant/%d', $tenantId), 'POST');
    }

    /**
     * @param array $include
     * @return mixed
     */
    public function user($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request('session/user', 'GET');
    }

    /**
     * @param array $include
     * @return mixed
     */
    public function network($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request('session/network', 'GET');
    }

    /**
     * @param $networkId
     * @return mixed
     */
    public function setNetwork($networkId)
    {
        return $this->setNetworkId($networkId);
//        return $this->request(sprintf('session/network/%d', $networkId), 'POST');
    }
}
