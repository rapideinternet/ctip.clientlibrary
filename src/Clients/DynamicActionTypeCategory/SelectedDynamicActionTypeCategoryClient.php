<?php

namespace Iza\Datacentralisatie\Clients\DynamicActionTypeCategory;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedDynamicActionTypeCategoryClient
 * @package Iza\Datacentralisatie\Clients\DynamicActionTypeCategory
 */
class SelectedDynamicActionTypeCategoryClient extends NestedClient
{
    protected $nestedObjects = [
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\DynamicActionTypeCategory\DynamicActionTypeCategoryDynamicActionTypeClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('dynamic_action_type_category/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('dynamic_action_type_category/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('dynamic_action_type_category/%s', $this->selectedId), 'DELETE');
    }
}
