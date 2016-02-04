<?php

namespace Iza\Datacentralisatie\Clients\DynamicActionType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class DynamicActionTypeAttributeClient extends NestedClient
{
    use PerPage;

    public function __construct($client, $id)
    {
        parent::__construct($client, $id);

    }

    public function byId($id)
    {
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('dynamic_action_type/%s/attribute', $this->selectedId));
    }

    public function create($data)
    {
        return $this->request(vsprintf('dynamic_action_type/%s/attribute', $this->selectedId), 'POST',
            json_encode($data))->getParsedResponse();
    }

    public function delete($data)
    {
        return $this->request(vsprintf('dynamic_action_type/%s/attribute', $this->selectedId), 'DELETE',
            json_encode($data))->getParsedResponse();
    }
}
