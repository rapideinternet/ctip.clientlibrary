<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedActionClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'attribute' => \Iza\Datacentralisatie\Clients\Action\ActionAttributeClient::class,
        'comment' => \Iza\Datacentralisatie\Clients\Action\ActionCommentClient::class,
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\Action\ActionDynamicActionTypeClient::class,
        'geoObject' => \Iza\Datacentralisatie\Clients\Action\ActionGeoObjectClient::class,
        'image' => \Iza\Datacentralisatie\Clients\Action\ActionImageClient::class,
        'mapObjectType' => \Iza\Datacentralisatie\Clients\Action\ActionMapObjectTypeClient::class,
        'mapObject' => \Iza\Datacentralisatie\Clients\Action\ActionMapObjectClient::class,
        'priority' => \Iza\Datacentralisatie\Clients\Action\ActionPriorityClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('action/%s', $this->selectedId), 'PATCH',
            $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('action/%s', $this->selectedId), 'DELETE');
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('action/%s', $id), 'GET');
    }
}
