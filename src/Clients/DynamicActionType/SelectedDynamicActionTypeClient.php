<?php

namespace Iza\Datacentralisatie\Clients\DynamicActionType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedDynamicActionTypeClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\DynamicActionType\DynamicActionTypeActionClient::class,
        'actionImageType' => \Iza\Datacentralisatie\Clients\DynamicActionType\DynamicActionTypeActionImageTypeClient::class,
        'attribute' => \Iza\Datacentralisatie\Clients\DynamicActionType\DynamicActionTypeAttributeClient::class,
        'mapObjectType' => \Iza\Datacentralisatie\Clients\DynamicActionType\DynamicActionTypeMapObjectTypeClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('dynamic_action_type/%s', $this->selectedId), 'PATCH',
            $data)->getParsedResponse();
    }

    public function delete()
    {
        return $this->request(vsprintf('dynamic_action_type/%s', $this->selectedId), 'DELETE')->getParsedResponse();
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('dynamic_action_type/%s', $id), 'GET');
    }
}
