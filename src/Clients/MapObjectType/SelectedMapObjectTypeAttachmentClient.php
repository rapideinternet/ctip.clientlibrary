<?php

namespace Iza\Datacentralisatie\Clients\MapObjectType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;

/**
 * Class SelectedMapObjectTypeAttachmentClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class SelectedMapObjectTypeAttachmentClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed|void
     * @throws NotImplementedException
     */
    public function byId($id, $include = [])
    {
        return $this->request(vsprintf('type/%s/attachment/%s', $this->selectedId), 'GET');
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('type/%s/attachment/%s', $this->selectedId), 'DELETE');
    }
}
