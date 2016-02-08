<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedActionCommentClient extends NestedClient
{
    use PerPage;

    public function byId($id)
    {
        return $this->request(vsprintf('action/%s/comment/%s', $this->selectedId), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('action/%s/comment/%s', $this->selectedId), 'PATCH',
            $data)->getParsedResponse();
    }

    public function delete($data)
    {
        return $this->request(vsprintf('action/%s/comment', $this->selectedId), 'DELETE',
            $data)->getParsedResponse();
    }

}
