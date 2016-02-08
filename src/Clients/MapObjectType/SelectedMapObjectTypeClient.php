<?php

namespace Iza\Datacentralisatie\Clients\MapObjectType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedMapObjectTypeClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeActionClient::class,
        'attribute' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeAttributeClient::class,
        'constraint' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeConstraintClient::class,
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeDynamicActionTypeClient::class,
        'status' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeStatusClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('type/%s', $this->selectedId), 'PATCH',
            $data)->getParsedResponse();
    }

    public function delete()
    {
        return $this->request(vsprintf('type/%s', $this->selectedId), 'DELETE')->getParsedResponse();
    }

    public function byId($id)
    {
        return $this->request(vsprintf('type/%s', $id), 'GET');
    }
}