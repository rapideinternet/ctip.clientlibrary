<?php

namespace Iza\Datacentralisatie\Clients\Network;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;

/**
 * Class SelectedNetworkAttachmentClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class SelectedNetworkAttachmentClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed|void
     * @throws NotImplementedException
     */
    public function byId($id, $include = [])
    {
        return $this->request(vsprintf('network/%s/attachment/%s', $this->selectedId), 'GET');
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('network/%s/attachment/%s', $this->selectedId), 'DELETE');
    }
}
