<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;

/**
 * Class SelectedMapObjectAttachmentClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class SelectedMapObjectAttachmentClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed|void
     * @throws NotImplementedException
     */
    public function byId($id, $include = [])
    {
        return $this->request(vsprintf('object/%s/attachment/%s', $this->selectedId), 'GET');
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('object/%s/attachment/%s', $this->selectedId), 'DELETE');
    }
}
