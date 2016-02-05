<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class ActionCommentClient extends NestedClient
{
    use PerPage;

    public function __construct($client, $id)
    {
        parent::__construct($client, $id);

    }

    public function byId($id)
    {
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('action/%s/comment', $this->selectedId));
    }

    public function create($data)
    {
        return $this->request(vsprintf('action/%s/comment', $this->selectedId), 'POST',
            json_encode($data))->getParsedResponse();
    }

    public function delete($data)
    {
        return $this->request(vsprintf('action/%s/comment', $this->selectedId), 'DELETE',
            json_encode($data))->getParsedResponse();
    }
}
