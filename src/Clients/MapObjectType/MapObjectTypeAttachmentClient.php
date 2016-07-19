<?php

namespace Iza\Datacentralisatie\Clients\MapObjectType;

use ArrayAccess;
use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class MapObjectTypeAttachmentClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class MapObjectTypeAttachmentClient extends NestedClient implements ArrayAccess
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->request(vsprintf('type/%s/attachment', $this->selectedId));
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
        $data['size'] = $file->getClientSize();
        $response = $this->request(vsprintf('type/%s/attachment', $this->selectedId), 'POST', $data);

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
     * @return SelectedMapObjectTypeAttachmentClient
     */
    public function offsetGet($offset)
    {
        array_push($this->selectedId, $offset);

        return new SelectedMapObjectTypeAttachmentClient($this->client, $this->selectedId);
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
