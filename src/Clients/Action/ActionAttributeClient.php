<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class ActionAttributeClient extends NestedClient
{
    use PerPage;

    public function __construct($client, $id)
    {
        parent::__construct($client, $id);

    }

    public function byId($id)
    {
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('action/%s/attribute', $this->selectedId));
    }

    public function update($data, $id)
    {
        return $this->request(vsprintf('action/%s/attribute/%s', $this->selectedId, $id), 'PATCH',
            json_encode($data))->getParsedResponse();
    }

    public function byMapObjectType()
    {
        return $this->request(vsprintf('action/%s/attribute/map_object_type', $this->selectedId));
    }

    public function byDynamicActionType()
    {
        return $this->request(vsprintf('action/%s/attribute/dynamic_action_type', $this->selectedId));
    }

}
