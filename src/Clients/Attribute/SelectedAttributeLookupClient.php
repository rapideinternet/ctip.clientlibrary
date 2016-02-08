<?php

namespace Iza\Datacentralisatie\Clients\Attribute;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedAttributeLookupClient extends NestedClient
{
    use PerPage;

    public function byId($id)
    {
        throw new NotImplementedException;
    }

    public function update($data)
    {
        return $this->request(vsprintf('attribute/%s/lookup/%s', $this->selectedId), 'PATCH',
            json_encode($data))->getParsedResponse();
    }
}
