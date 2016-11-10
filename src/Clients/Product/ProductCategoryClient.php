<?php

namespace Iza\Datacentralisatie\Clients\Product;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class ProductCategoryClient
 * @package Iza\Datacentralisatie\Clients\Product
 */
class ProductCategoryClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('product/%s/product_category', $this->selectedId));
    }
}