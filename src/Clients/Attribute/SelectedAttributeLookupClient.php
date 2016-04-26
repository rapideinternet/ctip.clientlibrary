<?php

namespace Iza\Datacentralisatie\Clients\Attribute;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedAttributeLookupClient extends NestedClient
{
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('attribute/%s/lookup/%s', $this->selectedId), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('attribute/%s/lookup/%s', $this->selectedId), 'PATCH',
            $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('attribute/%s/lookup/%s', $this->selectedId), 'DELETE');
    }
}
