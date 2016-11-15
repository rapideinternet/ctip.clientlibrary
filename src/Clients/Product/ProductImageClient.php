<?php

namespace Iza\Datacentralisatie\Clients\Product;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ProductImageClient
 * @package Iza\Datacentralisatie\Clients\Product
 */
class ProductImageClient extends NestedClient implements ArrayAccess
{

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
     * @param array $include
     * @return mixed
     */
    public function all()
    {
        return $this->request(vsprintf('product/%s/image', $this->selectedId));
    }

    /**
     * @param UploadedFile $file
     * @param $data
     * @return mixed
     */
    public function create(UploadedFile $file, $data)
    {
        return $this->fileRequest(vsprintf('product/%s/image', $this->selectedId), $file, $data);
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
     * @return NotImplementedException
     */
    public function offsetGet($offset)
    {
        throw new NotImplementedException;
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
