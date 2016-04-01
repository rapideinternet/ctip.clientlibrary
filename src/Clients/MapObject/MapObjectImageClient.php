<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MapObjectImageClient extends NestedClient implements ArrayAccess
{
    public function all($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s/image', $this->selectedId));
    }

    public function byId($id, $include = [])
    {
        return $this->all($include);
    }

    public function create(UploadedFile $file, $data)
    {
        return $this->fileRequest(vsprintf('object/%s/image', $this->selectedId), $file, $data);
    }

    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    public function offsetGet($offset)
    {
        array_push($this->selectedId, $offset);

        return new SelectedMapObjectImageClient($this->client, $this->selectedId);
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
