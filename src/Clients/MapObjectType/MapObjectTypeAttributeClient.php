<?php

namespace Iza\Datacentralisatie\Clients\MapObjectType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;
use Iza\Datacentralisatie\Traits\Sync;

class MapObjectTypeAttributeClient extends NestedClient
{
    use Sync;

    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('type/%s/attribute', $this->selectedId));
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

        return $this->request(vsprintf('type/%s/attribute', $this->selectedId), 'POST',
            $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('type/%s/attribute', $this->selectedId), 'DELETE',
            $data);
    }

}