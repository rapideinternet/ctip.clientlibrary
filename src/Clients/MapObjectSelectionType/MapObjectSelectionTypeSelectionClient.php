<?php

namespace Iza\Datacentralisatie\Clients\MapObjectSelectionType;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class MapObjectSelectionTypeSelectionClient extends NestedClient
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

        return $this->request(vsprintf('selection_types/%s/selection', $this->selectedId));
    }
}
