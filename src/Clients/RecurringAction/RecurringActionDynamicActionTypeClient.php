<?php

namespace Iza\Datacentralisatie\Clients\RecurringAction;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class RecurringActionDynamicActionTypeClient
 * @package Iza\Datacentralisatie\Clients\RecurringAction
 */
class RecurringActionDynamicActionTypeClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('recurring_action/%s/dynamic_action_type', $this->selectedId));
    }
}
