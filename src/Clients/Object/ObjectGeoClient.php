<?php

namespace Iza\Datacentralisatie\Clients\Object;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class ObjectGeoClient extends NestedClient implements ArrayAccess
{
    use PerPage;

    public function __construct($client, $id)
    {
        parent::__construct($client, $id);

    }

    public function byId($id)
    {
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('object/%s/geo', $this->selectedId));
    }

    public function create($data)
    {
        return $this->request(vsprintf('object/%s/geo', $this->selectedId), 'POST',
            json_encode($data))->getParsedResponse();
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        array_push($this->selectedId, $offset);

        return new SelectedObjectGeoClient($this->client, $this->selectedId);
    }

    public function offsetSet($offset, $value)
    {
        throw new NotImplementedException;
    }

    public function offsetUnset($offset)
    {
        throw new NotImplementedException;
    }
}