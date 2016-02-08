<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedMapObjectCommentClient extends NestedClient
{
    use PerPage;

    public function byId($id)
    {
        return $this->request(vsprintf('object/%s/comment/%s', $this->selectedId), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('object/%s/comment/%s', $this->selectedId), 'PATCH',
            $data)->getParsedResponse();
    }

    public function delete()
    {
        return $this->request(vsprintf('object/%s/comment/%s', $this->selectedId), 'DELETE')->getParsedResponse();
    }
}
