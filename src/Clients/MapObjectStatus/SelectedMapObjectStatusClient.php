<?php

namespace Iza\Datacentralisatie\Clients\MapObjectStatus;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedMapObjectStatusClient
 * @package Iza\Datacentralisatie\Clients\MapObjectStatus
 */
class SelectedMapObjectStatusClient extends NestedClient
{
    protected $nestedObjects = [
        'mapObjectType' => \Iza\Datacentralisatie\Clients\MapObjectStatus\MapObjectStatusTypeClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('map_object_status/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('map_object_status/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('map_object_status/%s', $this->selectedId), 'DELETE');
    }
}
