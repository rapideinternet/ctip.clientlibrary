<?php

namespace Iza\Datacentralisatie\Clients\ActionImageType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedActionImageTypeClient
 * @package Iza\Datacentralisatie\Clients\ActionImageType
 */
class SelectedActionImageTypeClient extends NestedClient
{
    protected $nestedObjects = [
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\ActionImageType\ActionImageTypeDynamicActionTypeClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('action_image_type/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('action_image_type/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('action_image_type/%s', $this->selectedId), 'DELETE');
    }
}
