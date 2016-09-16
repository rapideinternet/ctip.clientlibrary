<?php

namespace Iza\Datacentralisatie\Clients\Account;

use Iza\Datacentralisatie\Clients\BaseClient;

/**
 * Class AccountClient
 * @package Iza\Datacentralisatie\Clients\User
 */
class AccountClient extends BaseClient
{

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function account($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request('account', 'GET');
    }

    public function tenants($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request('account/tenant', 'GET');
    }

    public function getResetToken($username)
    {
        $this->setRaw();

        return $this->request('account/reset', 'POST', ['username' => $username]);
    }

    public function validateResetToken($token, $username)
    {
        $this->setRaw();

        $this->addParameter('username', $username);

        return $this->request(sprintf('account/reset/%s', $token), 'GET');
    }

    public function resetPassword($token, $password)
    {
        $this->setRaw();

        return $this->request(sprintf('account/reset/%s', $token), 'POST', ['password' => $password]);
    }
}