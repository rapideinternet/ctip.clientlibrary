<?php

namespace Iza\Datacentralisatie\Clients\Product;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ProductImageClient
 * @package Iza\Datacentralisatie\Clients\Product
 */
class ProductImageClient extends NestedClient implements ArrayAccess
{
    use PerPage;

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
