<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class MapObjectImageClient extends NestedClient
{
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s/image', $this->selectedId));
    }

    public function create($data)
    {
        throw new NotImplementedException;
    }

    public function update($data)
    {
        throw new NotImplementedException;
    }

    public function delete($data)
    {
        throw new NotImplementedException;
    }
}
