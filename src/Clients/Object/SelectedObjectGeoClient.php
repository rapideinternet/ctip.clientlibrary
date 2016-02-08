<?php

namespace Iza\Datacentralisatie\Clients\Object;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedObjectGeoClient extends NestedClient
{
    use PerPage;

    public function byId($id)
    {
        throw new NotImplementedException;
    }

    public function update($data)
    {
        return $this->request(vsprintf('object/%s/geo/%s', $this->selectedId), 'PATCH',
            $data)->getParsedResponse();
    }
}
