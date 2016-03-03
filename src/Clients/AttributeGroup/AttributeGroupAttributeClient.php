<?php

namespace Iza\Datacentralisatie\Clients\AttributeGroup;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class AttributeGroupAttributeClient extends NestedClient
{
    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('attribute_group/%s/attribute', $this->selectedId));
    }

    public function byId($id, $include = [])
    {
        return $this->all($include);
    }
}
