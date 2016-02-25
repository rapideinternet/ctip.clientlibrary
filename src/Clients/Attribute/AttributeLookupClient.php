<?php

namespace Iza\Datacentralisatie\Clients\Attribute;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class AttributeLookupClient extends NestedClient implements ArrayAccess
{
    use PerPage;

    public function __construct($client, $id)
    {
        parent::__construct($client, $id);

    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('attribute/%s/lookup', $this->selectedId));
    }

    public function create($data)
    {
        return $this->request('attribute/%s/lookup', 'POST', $data);
    }


    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        array_push($this->selectedId, $offset);

        return new SelectedAttributeLookupClient($this->client, $this->selectedId);
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
