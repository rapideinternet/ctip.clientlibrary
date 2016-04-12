<?php

namespace Iza\Datacentralisatie\Clients\User;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedUserClient extends NestedClient
{
    protected $nestedObjects = [
        'tenant' => \Iza\Datacentralisatie\Clients\User\UserTenantClient::class,
    ];

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('user/%s', $id), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('user/%s', $this->selectedId), 'PATCH', $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('user/%s', $this->selectedId), 'DELETE', $data);
    }
}
