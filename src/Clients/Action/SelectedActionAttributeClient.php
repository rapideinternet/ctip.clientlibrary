<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedActionAttributeClient extends NestedClient
{
    use PerPage;

    public function byId($id, $include = [])
    {
        throw new NotImplementedException;
    }

    public function update($data)
    {
        return $this->request(vsprintf('action/%s/attribute/%s', $this->selectedId), 'PATCH',
            $data);
    }
}