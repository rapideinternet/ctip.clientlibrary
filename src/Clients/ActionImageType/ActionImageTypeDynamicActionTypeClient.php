<?php

namespace Iza\Datacentralisatie\Clients\ActionImageType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class ActionImageTypeDynamicActionTypeClient extends NestedClient
{
    use PerPage;

    public function __construct($client, $id)
    {
        parent::__construct($client, $id);

    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('action_image_type/%s/dynamic_action_type', $this->selectedId));
    }

    public function create($data)
    {
        return $this->request(vsprintf('action_image_type/%s/dynamic_action_type', $this->selectedId), 'POST',
            $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('action_image_type/%s/dynamic_action_type', $this->selectedId), 'DELETE',
            $data);
    }
}
