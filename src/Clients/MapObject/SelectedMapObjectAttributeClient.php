<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;

/**
 * Class SelectedMapObjectAttributeClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class SelectedMapObjectAttributeClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed|void
     * @throws NotImplementedException
     */
    public function byId($id, $include = [])
    {
        throw new NotImplementedException;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('object/%s/attribute/%s', $this->selectedId), 'PATCH',
            $data);
    }
}
