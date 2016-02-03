<?php

namespace Iza\Datacentralisatie\Clients;

use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedObjectClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'children' => \Iza\Datacentralisatie\Clients\ChildrenObjectClient::class
    ];

    public function children($filter = [])
    {

    }

    public function update($data)
    {
        return $this->request(vsprintf('object/%s', $this->selectedIds), $data);
    }

    public function byId($id)
    {
        return $this->request(vsprintf('object/%s', $id), 'GET');
    }
}