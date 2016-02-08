<?php

namespace Iza\Datacentralisatie\Clients\Object;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedObjectClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\Object\ObjectActionClient::class,
        'attribute' => \Iza\Datacentralisatie\Clients\Object\ObjectAttributeClient::class,
        'category' => \Iza\Datacentralisatie\Clients\Object\ObjectCategoryClient::class,
        'children' => \Iza\Datacentralisatie\Clients\Object\ObjectChildrenClient::class,
        'comment' => \Iza\Datacentralisatie\Clients\Object\ObjectCommentClient::class,
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\Object\ObjectDynamicActiontypeClient::class,
        'geo' => \Iza\Datacentralisatie\Clients\Object\ObjectGeoClient::class,
        'image' => \Iza\Datacentralisatie\Clients\Object\ObjectImageClient::class,
        'parent' => \Iza\Datacentralisatie\Clients\Object\ObjectParentClient::class,
        'status' => \Iza\Datacentralisatie\Clients\Object\ObjectStatusClient::class,
        'type' => \Iza\Datacentralisatie\Clients\Object\ObjectTypeClient::class,
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