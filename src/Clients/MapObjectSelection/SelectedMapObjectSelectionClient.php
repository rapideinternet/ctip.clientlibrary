<?php

namespace Iza\Datacentralisatie\Clients\MapObjectSelection;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedMapObjectSelectionClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'object' => \Iza\Datacentralisatie\Clients\MapObjectSelection\MapObjectSelectionObjectClient::class,
        'type' => \Iza\Datacentralisatie\Clients\MapObjectSelection\MapObjectSelectionTypeClient::class,
        'image' => \Iza\Datacentralisatie\Clients\MapObjectSelection\MapObjectSelectionImageClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('selection/%s', $this->selectedId), 'PATCH', $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('selection/%s', $this->selectedId), 'DELETE', $data);
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('selection/%s', $id), 'GET');
    }
}