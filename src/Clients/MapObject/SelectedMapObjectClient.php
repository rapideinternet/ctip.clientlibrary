<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedMapObjectClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class SelectedMapObjectClient extends NestedClient
{
    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectActionClient::class,
        'attachment' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectAttachmentClient::class,
        'attribute' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectAttributeClient::class,
        'category' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectCategoryClient::class,
        'children' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectChildrenClient::class,
        'comment' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectCommentClient::class,
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectDynamicActiontypeClient::class,
        'geo' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectGeoClient::class,
        'image' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectImageClient::class,
        'linestring' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectLinestringClient::class,
        'parent' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectParentClient::class,
        'parents' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectParentsClient::class,
        'selection' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectMapObjectSelectionClient::class,
        'status' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectStatusClient::class,
        'type' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectTypeClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('object/%s', $this->selectedId), 'PATCH', $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('object/%s', $this->selectedId), 'DELETE');
    }
}
