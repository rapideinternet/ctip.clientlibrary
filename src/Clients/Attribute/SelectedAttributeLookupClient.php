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
        return $this->request(vsprintf('attribute/%s/lookup/%s', $this->selectedId), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('attribute/%s/lookup/%s', $this->selectedId), 'PATCH',
            $data)->getParsedResponse();
    }

    public function delete($data)
    {
        return $this->request(vsprintf('attribute/%s/lookup/%s', $this->selectedId), 'DELETE',
            $data)->getParsedResponse();
    }
}
