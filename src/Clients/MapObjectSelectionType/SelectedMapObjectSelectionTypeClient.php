<?php

namespace Iza\Datacentralisatie\Clients\MapObjectSelectionType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedMapObjectSelectionTypeClient
 * @package Iza\Datacentralisatie\Clients\MapObjectSelectionType
 */
class SelectedMapObjectSelectionTypeClient extends NestedClient
{
    protected $nestedObjects = [
        'attribute' => \Iza\Datacentralisatie\Clients\MapObjectSelectionType\MapObjectSelectionTypeAttributeClient::class,
        'selection' => \Iza\Datacentralisatie\Clients\MapObjectSelectionType\MapObjectSelectionTypeSelectionClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('selection_type/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('selection_type/%s', $this->selectedId), 'PATCH', $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('selection_type/%s', $this->selectedId), 'DELETE');
    }
}