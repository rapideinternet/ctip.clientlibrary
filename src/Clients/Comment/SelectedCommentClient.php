<?php

namespace Iza\Datacentralisatie\Clients\Comment;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedCommentClient extends NestedClient
{
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('comment/%s', $id), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('comment/%s', $this->selectedId), 'PATCH', $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('comment/%s', $this->selectedId), 'DELETE');
    }
}
