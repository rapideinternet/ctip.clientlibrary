<?php

namespace Iza\Datacentralisatie\Clients\MapObjectSelection;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class MapObjectSelectionImageClient
 * @package Iza\Datacentralisatie\Clients\MapObjectSelection
 */
class MapObjectSelectionImageClient extends NestedClient implements ArrayAccess
{
    use PerPage;

    /**
     * @param array $include
     * @param array $filter
     * @return mixed
     */
    public function all($include = [], $filter = [])
    {
        $this->addFilters($filter);
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);
        $this->addParameter('page', $this->page);

        return $this->request(vsprintf('selection/%s/image', $this->selectedId));
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
        return $this->fileRequest(vsprintf('selection/%s/image', $this->selectedId), $file, $data);
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
     * @return SelectedMapObjectSelectionImageClient
     */
    public function offsetGet($offset)
    {
        array_push($this->selectedId, $offset);

        return new SelectedMapObjectSelectionImageClient($this->client, $this->selectedId);
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

