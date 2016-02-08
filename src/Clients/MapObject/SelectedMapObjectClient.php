<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedMapObjectClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectActionClient::class,
        'attribute' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectAttributeClient::class,
        'category' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectCategoryClient::class,
        'children' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectChildrenClient::class,
        'comment' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectCommentClient::class,
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectDynamicActiontypeClient::class,
        'geo' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectGeoClient::class,
        'image' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectImageClient::class,
        'parent' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectParentClient::class,
        'status' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectStatusClient::class,
        'type' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectTypeClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('object/%s', $this->selectedId), 'PATCH', $data)->getParsedResponse();
    }

    public function delete($data)
    {
        return $this->request(vsprintf('object/%s', $this->selectedId), 'DELETE', $data)->getParsedResponse();
    }

    public function byId($id)
    {
        return $this->request(vsprintf('object/%s', $id), 'GET');
    }
}