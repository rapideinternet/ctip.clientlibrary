<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedActionProductsClient
 * @package Iza\Datacentralisatie\Clients\Action
 */
class SelectedActionProductsClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('action/%s/products/%s', $this->selectedId), 'GET');
    }
}
