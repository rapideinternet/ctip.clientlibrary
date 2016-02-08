<?php

namespace Iza\Datacentralisatie\Clients\Tenant;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedTenantClient extends NestedClient
{
    use PerPage;

    public function update($data)
    {
        return $this->request(vsprintf('tenant/%s', $this->selectedId), 'PATCH', $data)->getParsedResponse();
    }

    public function delete($data)
    {
        return $this->request(vsprintf('tenant/%s', $this->selectedId), 'DELETE', $data)->getParsedResponse();
    }

    public function byId($id)
    {
        return $this->request(vsprintf('tenant/%s', $id), 'GET');
    }
}