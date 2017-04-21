<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\IsNested;
use Iza\Datacentralisatie\Traits\PerPage;
use Iza\Datacentralisatie\Traits\Sort;

/**
 * Class MapObjectRecurringActionClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class MapObjectRecurringActionClient extends NestedClient
{
    use PerPage, Sort, IsNested;

    /**
     * @param array $include
     * @param array $filter
     * @return mixed
     */
    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);
        $this->addParameter('sort', $this->getSort());
        $this->addParameter('nested', $this->isNested);

        return $this->request(vsprintf('object/%s/recurring_action', $this->selectedId));
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        return $this->all($include);
    }
}
