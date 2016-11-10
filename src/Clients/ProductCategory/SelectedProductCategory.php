<?php

namespace Iza\Datacentralisatie\Clients\ProductCategory;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedCategoryClient
 * @package Iza\Datacentralisatie\Clients\ProductCategory
 */
class SelectedProductCategoryClient extends NestedClient
{
    protected $nestedObjects = [
        'product' => \Iza\Datacentralisatie\Clients\ProductCategory\ProductCategoryProductClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('product_category/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('product_category/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('product_category/%s', $this->selectedId), 'DELETE');
    }
}
