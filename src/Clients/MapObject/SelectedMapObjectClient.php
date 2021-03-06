<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\RemoveActions;

/**
 * Class SelectedMapObjectClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class SelectedMapObjectClient extends NestedClient
{
    use RemoveActions;

    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectActionClient::class,
        'attachment' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectAttachmentClient::class,
        'attribute' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectAttributeClient::class,
        'category' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectCategoryClient::class,
        'children' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectChildrenClient::class,
        'comment' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectCommentClient::class,
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectDynamicActionTypeClient::class,
        'geo' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectGeoClient::class,
        'image' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectImageClient::class,
        'linestring' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectLinestringClient::class,
        'network' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectNetworkClient::class,
        'parent' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectParentClient::class,
        'parents' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectParentsClient::class,
        'product' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectProductsClient::class,
        'recurringAction' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectRecurringActionClient::class,
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
     * @param array $include
     * @return mixed
     */
    public function deleted($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s/deleted', $this->selectedId), 'GET');
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
     * @param $data
     * @return mixed
     */
    public function split($data)
    {
        return $this->request(vsprintf('object/%s/split', $this->selectedId), 'POST', $data, [], true, 'v2');
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        if($this->removeActions === true) {
            $this->addParameter('remove_actions', $this->removeActions);
        }
        return $this->request(vsprintf('object/%s', $this->selectedId), 'DELETE');
    }
}
