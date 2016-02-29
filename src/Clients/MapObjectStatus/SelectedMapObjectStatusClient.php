<?php

namespace Iza\Datacentralisatie\Clients\MapObjectStatus;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedMapObjectStatusClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'mapObjectType' => \Iza\Datacentralisatie\Clients\MapObjectStatus\MapObjectStatusTypeClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('map_object_status/%s', $this->selectedId), 'PATCH',
            $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('map_object_status/%s', $this->selectedId), 'DELETE');
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('map_object_status/%s', $id), 'GET');
    }
}
