<?php

namespace Iza\Datacentralisatie\Clients\Object;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedObjectClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'children' => \Iza\Datacentralisatie\Clients\Object\ChildrenObjectClient::class
    ];

    public function update($data)
    {
        return $this->request(vsprintf('object/%s', $this->selectedIds), 'PATCH', $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('object/%s', $this->selectedIds), 'DELETE', $data);
    }

    public function byId($id)
    {
        return $this->request(vsprintf('object/%s', $id), 'GET');
    }
}