<?php

namespace Iza\Datacentralisatie\Clients\MapObjectStatus;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;
use Iza\Datacentralisatie\Traits\Sync;

class MapObjectStatusTypeClient extends NestedClient
{
    use Sync;

    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('map_object_status/%s/map_object_type', $this->selectedId));
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

        return $this->request(vsprintf('map_object_status/%s/map_object_type', $this->selectedId), 'POST',
            $data);
    }

    public function delete($data)
    {
        return $this->request(vsprintf('map_object_status/%s/map_object_type', $this->selectedId), 'DELETE',
            $data);
    }
}
