<?php

namespace Iza\Datacentralisatie\Clients\RecurringAction;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class RecurringActionMapObjectTypeClient
 * @package Iza\Datacentralisatie\Clients\RecurringAction
 */
class RecurringActionMapObjectTypeClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('recurring_action/%s/map_object_type', $this->selectedId));
    }
}
