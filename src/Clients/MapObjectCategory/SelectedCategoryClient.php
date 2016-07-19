<?php

namespace Iza\Datacentralisatie\Clients\MapObjectCategory;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedCategoryClient
 * @package Iza\Datacentralisatie\Clients\MapObjectCategory
 */
class SelectedCategoryClient extends NestedClient
{
    protected $nestedObjects = [
        'type' => \Iza\Datacentralisatie\Clients\MapObjectCategory\CategoryTypeClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('category/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('category/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('category/%s', $this->selectedId), 'DELETE');
    }
}
