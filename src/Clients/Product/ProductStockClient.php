<?php

namespace Iza\Datacentralisatie\Clients\Product;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class ProductStockClient
 * @package Iza\Datacentralisatie\Clients\Product
 */
class ProductStockClient extends NestedClient
{
    public function byId($id, $include = [])
    {
        return $this->request(vsprintf('product/%s/stock/', $this->selectedId));
    }

    public function all()
    {
        return $this->request(vsprintf('product/%s/stock/all', $this->selectedId));
    }

    public function create($data)
    {
        return $this->request(vsprintf('product/%s/stock', $this->selectedId), 'POST', $data);
    }
}