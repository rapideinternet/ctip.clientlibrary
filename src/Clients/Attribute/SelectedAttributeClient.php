<?php

namespace Iza\Datacentralisatie\Clients\Attribute;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedAttributeClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'lookup' => \Iza\Datacentralisatie\Clients\Attribute\AttributeLookupClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('attribute/%s', $this->selectedId), 'PATCH', $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('attribute/%s', $this->selectedId), 'DELETE', $data);
    }

    public function byId($id)
    {
        return $this->request(vsprintf('attribute/%s', $id), 'GET');
    }
}