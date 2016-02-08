<?php

namespace Iza\Datacentralisatie\Clients\Type;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class TypeAttributeClient extends NestedClient
{
    use PerPage;

    public function __construct($client, $id)
    {
        parent::__construct($client, $id);

    }

    public function byId($id)
    {
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('type/%s/attribute', $this->selectedId));
    }

    public function create($data)
    {
        return $this->request(vsprintf('type/%s/attribute', $this->selectedId), 'POST',
            $data)->getParsedResponse();
    }

    public function delete($data)
    {
        return $this->request(vsprintf('type/%s/attribute', $this->selectedId), 'DELETE',
            $data)->getParsedResponse();
    }

}