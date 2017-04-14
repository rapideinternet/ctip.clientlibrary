<?php

namespace Iza\Datacentralisatie\Clients\RecurringAction;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedRecurringActionCommentClient
 * @package Iza\Datacentralisatie\Clients\RecurringAction
 */
class SelectedRecurringActionCommentClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('recurring_action/%s/comment/%s', $this->selectedId), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('recurring_action/%s/comment/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('recurring_action/%s/comment/%s', $this->selectedId), 'DELETE');
    }
}
