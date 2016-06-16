<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;

/**
 * Class SelectedActionAttachmentClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class SelectedActionAttachmentClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed|void
     * @throws NotImplementedException
     */
    public function byId($id, $include = [])
    {
        return $this->request(vsprintf('action/%s/attachment/%s', $this->selectedId), 'GET');
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('action/%s/attachment/%s', $this->selectedId), 'DELETE');
    }
}
