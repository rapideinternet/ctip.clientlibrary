<?php

namespace Iza\Datacentralisatie\Clients\MapObjectSelection;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class MapObjectSelectionObjectClient extends NestedClient
{
    use PerPage;

    public function __construct($client, $id)
    {
        parent::__construct($client, $id);

    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('selection/%s/object', $this->selectedId));
    }

    public function create($data)
    {
        return $this->request(vsprintf('selection/%s/object', $this->selectedId), 'POST',
            $data)->getParsedResponse();
    }

    public function delete($data)
    {
        return $this->request(vsprintf('selection/%s/object', $this->selectedId), 'DELETE',
            $data)->getParsedResponse();
    }

}
