<?php

namespace Iza\Datacentralisatie\Clients\DynamicActionTypeCategory;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class DynamicActionTypeCategoryDynamicActionTypeClient extends NestedClient
{
    use PerPage;

    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request(vsprintf('dynamic_action_type_category/%s/dynamic_action_type', $this->selectedId));
    }

    public function byId($id, $include = [])
    {
        return $this->all($include);
    }
}