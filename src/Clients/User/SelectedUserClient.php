<?php

namespace Iza\Datacentralisatie\Clients\User;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedUserClient
 * @package Iza\Datacentralisatie\Clients\User
 */
class SelectedUserClient extends NestedClient
{
    protected $nestedObjects = [
        'tenant' => \Iza\Datacentralisatie\Clients\User\UserTenantClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('user/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('user/%s', $this->selectedId), 'PATCH', $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('user/%s', $this->selectedId), 'DELETE');
    }
}
