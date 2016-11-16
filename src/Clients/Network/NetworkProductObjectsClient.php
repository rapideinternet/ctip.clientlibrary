<?php

namespace Iza\Datacentralisatie\Clients\Network;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class NetworkProductObjectsClient
 * @package Iza\Datacentralisatie\Clients\Network
 */
class NetworkProductObjectsClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        return $this->all($include);
    }

    /**
     * @param array $include
     * @param array $filter
     * @return mixed
     */
    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        return $this->request(vsprintf('network/%s/product/object', $this->selectedId));
    }
}