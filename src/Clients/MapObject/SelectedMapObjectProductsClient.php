<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedMapObjectProductsClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class SelectedMapObjectProductsClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s/products/%s', $this->selectedId), 'GET');
    }
}
