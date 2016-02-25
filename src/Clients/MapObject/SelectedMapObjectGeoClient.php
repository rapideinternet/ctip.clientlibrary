<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedMapObjectGeoClient extends NestedClient
{
    use PerPage;

    public function byId($id, $include = [])
    {
        throw new NotImplementedException;
    }

    public function update($data)
    {
        return $this->request(vsprintf('object/%s/geo/%s', $this->selectedId), 'PATCH',
            $data)->getParsedResponse();
    }
}
