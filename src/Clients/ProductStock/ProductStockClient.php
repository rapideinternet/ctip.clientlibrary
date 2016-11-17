<?php

namespace Iza\Datacentralisatie\Clients\ProductStock;

use Iza\Datacentralisatie\Clients\BaseClient;

/**
 * Class ProductStockClient
 * @package Iza\Datacentralisatie\Clients\ProductStock
 */
class ProductStockClient extends BaseClient
{

    /**
     * @param array $include
     * @param array $filter
     * @return mixed
     */
    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        return $this->request('product_stock', 'GET');
    }
}
