<?php

namespace Iza\Datacentralisatie\Clients\MapObjectType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedMapObjectTypeClient
 * @package Iza\Datacentralisatie\Clients\MapObjectType
 */
class SelectedMapObjectTypeClient extends NestedClient
{
    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeActionClient::class,
        'actionStatus' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeActionStatusClient::class,
        'attribute' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeAttributeClient::class,
        'constraint' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeConstraintClient::class,
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeDynamicActionTypeClient::class,
        'setting' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeSettingClient::class,
        'selection' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeSelectionClient::class,
        'status' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeStatusClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('type/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('type/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('type/%s', $this->selectedId), 'DELETE');
    }
}