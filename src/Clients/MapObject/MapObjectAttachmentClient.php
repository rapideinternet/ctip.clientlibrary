<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class MapObjectAttachmentClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class MapObjectAttachmentClient extends NestedClient implements ArrayAccess
{
    /**
     * @return mixed
     */
    public function all($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s/attachment', $this->selectedId));
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        return $this->all();
    }

    /**
     * @param $data
     * @param UploadedFile $file
     * @return mixed
     */
    public function create($data, UploadedFile $file)
    {
        $data['size'] = $file->getSize();
        $response = $this->request(vsprintf('object/%s/attachment', $this->selectedId), 'POST', $data);

        if ($response->getInfo()->http_code != 200 || !isset($response->data->upload_url)) {
            return $response;
        }
        $url = $response->data->upload_url;

        return $this->binaryRequest($url, $file);

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
     * @return SelectedMapObjectAttachmentClient
     */
    public function offsetGet($offset)
    {
        array_push($this->selectedId, $offset);

        return new SelectedMapObjectAttachmentClient($this->client, $this->selectedId);
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
