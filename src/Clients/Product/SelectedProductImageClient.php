<?php

namespace Iza\Datacentralisatie\Clients\Product;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedProductImageClient
 * @package Iza\Datacentralisatie\Clients\Product
 */
class SelectedProductImageClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('product/%s/image/%s', $this->selectedId), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('product/%s/image/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('product/%s/image/%s', $this->selectedId), 'DELETE');
    }
}
