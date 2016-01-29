<?php

namespace Iza\Datacentralisatie\Clients;

use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedObjectClient extends NestedClient
{
    use PerPage;

    protected $object = null;

    public function children($filter = [])
    {
        $this->addParameter('include', implode(',', $filter));
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('object/%s/children', $this->selectedId));
    }

    public function update($data)
    {
        return $this->request(vsprintf('object/%s', $this->selectedIds));
    }

    public function byId($id)
    {
        return $this->request(vsprintf('object/%s', $id), 'GET');
    }
}