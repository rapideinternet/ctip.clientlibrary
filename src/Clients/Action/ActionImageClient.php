<?php

namespace Iza\Datacentralisatie\Clients\Action;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ActionImageClient
 * @package Iza\Datacentralisatie\Clients\Action
 */
class ActionImageClient extends NestedClient implements ArrayAccess
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

        return $this->request(vsprintf('action/%s/image', $this->selectedId));
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
        return $this->fileRequest(vsprintf('action/%s/image', $this->selectedId), $file, $data);
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
     * @return SelectedActionImageClient
     */
    public function offsetGet($offset)
    {
        array_push($this->selectedId, $offset);

        return new SelectedActionImageClient($this->client, $this->selectedId);
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

    /**
     * @return mixed
     */
    public function promote($mapObjectId = null)
    {
        if (is_null($mapObjectId)) {
            return $this->request(vsprintf('action/%s/image/promote', $this->selectedId));
        } else {
            array_push($this->selectedId, $mapObjectId);
            return $this->request(vsprintf('action/%s/image/promote/%s', $this->selectedId));
        }
    }
}
