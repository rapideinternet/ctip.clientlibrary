<?php

namespace Iza\Datacentralisatie\Clients\MapObjectSelection;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedMapObjectSelectionClient
 * @package Iza\Datacentralisatie\Clients\MapObjectSelection
 */
class SelectedMapObjectSelectionClient extends NestedClient
{
    protected $nestedObjects = [
        'attribute' => \Iza\Datacentralisatie\Clients\MapObjectSelection\MapObjectSelectionAttributeClient::class,
        'object' => \Iza\Datacentralisatie\Clients\MapObjectSelection\MapObjectSelectionObjectClient::class,
        'type' => \Iza\Datacentralisatie\Clients\MapObjectSelection\MapObjectSelectionTypeClient::class,
        'image' => \Iza\Datacentralisatie\Clients\MapObjectSelection\MapObjectSelectionImageClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('selection/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('selection/%s', $this->selectedId), 'PATCH', $data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function delete($data)
    {
        return $this->request(vsprintf('selection/%s', $this->selectedId), 'DELETE', $data);
    }
}