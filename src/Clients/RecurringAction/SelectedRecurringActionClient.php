<?php

namespace Iza\Datacentralisatie\Clients\RecurringAction;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedRecurringActionClient
 * @package Iza\Datacentralisatie\Clients\RecurringAction
 */
class SelectedRecurringActionClient extends NestedClient
{
    protected $nestedObjects = [
        'comment' => \Iza\Datacentralisatie\Clients\RecurringAction\RecurringActionCommentClient::class,
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\RecurringAction\RecurringActionDynamicActionTypeClient::class,
        'geoObject' => \Iza\Datacentralisatie\Clients\RecurringAction\RecurringActionGeoObjectClient::class,
        'image' => \Iza\Datacentralisatie\Clients\RecurringAction\RecurringActionImageClient::class,
        'mapObjectType' => \Iza\Datacentralisatie\Clients\RecurringAction\RecurringActionMapObjectTypeClient::class,
        'mapObject' => \Iza\Datacentralisatie\Clients\RecurringAction\RecurringActionMapObjectClient::class,
        'priority' => \Iza\Datacentralisatie\Clients\RecurringAction\RecurringActionPriorityClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('recurring_action/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('recurring_action/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('recurring_action/%s', $this->selectedId), 'DELETE');
    }
}
