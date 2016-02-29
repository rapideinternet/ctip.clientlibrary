<?php

namespace Iza\Datacentralisatie\Clients\ActionPriority;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedActionPriorityClient extends NestedClient
{
    use PerPage;

    public function update($data)
    {
        return $this->request(vsprintf('action_priority/%s', $this->selectedId), 'PATCH',
            $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('action_priority/%s', $this->selectedId), 'DELETE');
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('action_priority/%s', $id), 'GET');
    }
}
