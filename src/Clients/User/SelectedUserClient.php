<?php

namespace Iza\Datacentralisatie\Clients\User;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedUserClient extends NestedClient
{
    use PerPage;

    public function update($data)
    {
        return $this->request(vsprintf('user/%s', $this->selectedId), 'PATCH', $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('user/%s', $this->selectedId), 'DELETE', $data);
    }

    public function byId($id)
    {
        return $this->request(sprintf('user/%s', $id), 'GET');
    }
}