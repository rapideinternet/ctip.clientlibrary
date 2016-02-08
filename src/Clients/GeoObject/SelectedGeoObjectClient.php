<?php

namespace Iza\Datacentralisatie\Clients\GeoObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedGeoObjectClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'attribute' => \Iza\Datacentralisatie\Clients\GeoObject\GeoObjectAttributeClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('geo/%s', $this->selectedId), 'PATCH',
            $data)->getParsedResponse();
    }

    public function delete()
    {
        return $this->request(vsprintf('geo/%s', $this->selectedId), 'DELETE')->getParsedResponse();
    }

    public function byId($id)
    {
        return $this->request(vsprintf('geo/%s', $id), 'GET');
    }
}
