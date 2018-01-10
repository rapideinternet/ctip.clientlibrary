<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class MapObjectImageClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class MapObjectImageClient extends NestedClient implements ArrayAccess
{
    use PerPage;

    /**
     * @param array $include
     * @return mixed
     */
    public function all($include = [])
    {
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request(vsprintf('object/%s/image', $this->selectedId));
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        return $this->all($include);
    }

    /**
     * @param UploadedFile $file
     * @param $data
     * @return mixed
     */
    public function create(UploadedFile $file, $data)
    {
        return $this->fileRequest(vsprintf('object/%s/image', $this->selectedId), $file, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function copy($target_id)
    {
        return $this->request(vsprintf('object/%s/image/copy/%s', array_merge($this->selectedId, [$target_id])), 'POST');
    }

    /**
     * @param mixed $offset
     * @return bool|void
     * @throws NotImplementedException
     */
    public function offsetExists($offset)
    {
        throw new NotImplementedException;
    }

    /**
     * @param mixed $offset
     * @return SelectedMapObjectImageClient
     */
    public function offsetGet($offset)
    {
        $this->selectedId[] = $offset;

        return new SelectedMapObjectImageClient($this->client, $this->selectedId);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @throws NotImplementedException
     */
    public function offsetSet($offset, $value)
    {
        throw new NotImplementedException;
    }

    /**
     * @param mixed $offset
     * @throws NotImplementedException
     */
    public function offsetUnset($offset)
    {
        throw new NotImplementedException;
    }
}
