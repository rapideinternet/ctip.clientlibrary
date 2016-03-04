<?php

namespace Iza\Datacentralisatie\Clients\ActionImageType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;
use Iza\Datacentralisatie\Traits\Sync;

class ActionImageTypeDynamicActionTypeClient extends NestedClient
{
    use PerPage, Sync;

    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request(vsprintf('action_image_type/%s/dynamic_action_type', $this->selectedId));
    }

    public function byId($id, $include = [])
    {
        return $this->all($include);
    }

    public function create($data)
    {
        if ($this->sync) {
            $this->addParameter('sync', $this->sync);
        }

        return $this->request(vsprintf('action_image_type/%s/dynamic_action_type', $this->selectedId), 'POST',
            $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('action_image_type/%s/dynamic_action_type', $this->selectedId), 'DELETE',
            $data);
    }
}
