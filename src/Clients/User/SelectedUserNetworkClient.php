<?php

namespace Iza\Datacentralisatie\Clients\User;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedUserNetworkClient
 * @package Iza\Datacentralisatie\Clients\User
 */
class SelectedUserNetworkClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('user/%s/network/%s', $this->selectedId), 'GET');
    }
}
