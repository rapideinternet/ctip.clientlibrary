<?php

namespace Iza\Datacentralisatie\Clients\RecurringAction;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class ActionPriorityClient
 * @package Iza\Datacentralisatie\Clients\Action
 */
class RecurringActionPriorityClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('recurring_action/%s/priority', $this->selectedId));
    }
}
