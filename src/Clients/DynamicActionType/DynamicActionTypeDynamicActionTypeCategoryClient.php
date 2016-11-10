<?php

namespace Iza\Datacentralisatie\Clients\DynamicActionType;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class DynamicActionTypeDynamicActionTypeCategoryClient
 * @package Iza\Datacentralisatie\Clients\DynamicActionType
 */
class DynamicActionTypeDynamicActionTypeCategoryClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('dynamic_action_type/%s/dynamic_action_type_category', $this->selectedId));
    }
}