<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedActionCommentClient extends NestedClient
{
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('action/%s/comment/%s', $this->selectedId), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('action/%s/comment/%s', $this->selectedId), 'PATCH',
            $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('action/%s/comment/%s', $this->selectedId), 'DELETE');
    }
}
