<?php

namespace Iza\Datacentralisatie\Clients\ProductCategory;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class ProductCategoryProductClient
 * @package Iza\Datacentralisatie\Clients\ProductCategory
 */
class ProductCategoryProductClient extends NestedClient
{
    use PerPage;

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
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request(vsprintf('product_category/%s/product', $this->selectedId));
    }
}
