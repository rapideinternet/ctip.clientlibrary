<?php

namespace Iza\Datacentralisatie\Clients\GeoObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedGeoObjectClient extends NestedClient
{
    protected $nestedObjects = [
        'attribute' => \Iza\Datacentralisatie\Clients\GeoObject\GeoObjectAttributeClient::class,
    ];

    public function byId($id, $include = [])
    {
        throw new NotImplementedException;
    }

    public function update($data)
    {
        return $this->request(vsprintf('geo/%s', $this->selectedId), 'PATCH',
            $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('geo/%s', $this->selectedId), 'DELETE');
    }
}
