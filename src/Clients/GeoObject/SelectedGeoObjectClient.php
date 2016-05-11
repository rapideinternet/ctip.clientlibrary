<?php

namespace Iza\Datacentralisatie\Clients\GeoObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;

/**
 * Class SelectedGeoObjectClient
 * @package Iza\Datacentralisatie\Clients\GeoObject
 */
class SelectedGeoObjectClient extends NestedClient
{
    protected $nestedObjects = [
        'attribute' => \Iza\Datacentralisatie\Clients\GeoObject\GeoObjectAttributeClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed|void
     * @throws NotImplementedException
     */
    public function byId($id, $include = [])
    {
        throw new NotImplementedException;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('geo/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('geo/%s', $this->selectedId), 'DELETE');
    }
}
