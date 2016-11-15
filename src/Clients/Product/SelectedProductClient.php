<?php

namespace Iza\Datacentralisatie\Clients\Product;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Traits\PerPage;

/**
 * Class SelectedProductClient
 * @package Iza\Datacentralisatie\Clients\Product
 */
class SelectedProductClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'image' => \Iza\Datacentralisatie\Clients\Product\ProductImageClient::class,
        'productCategory' => \Iza\Datacentralisatie\Clients\Product\ProductCategoryClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('product/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('product/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('product/%s', $this->selectedId), 'DELETE');
    }
}