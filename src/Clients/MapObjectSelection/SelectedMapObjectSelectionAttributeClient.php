<?php

namespace Iza\Datacentralisatie\Clients\MapObjectSelection;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;

/**
 * Class SelectedMapObjectSelectionAttributeClient
 * @package Iza\Datacentralisatie\Clients\MapObjectSelection
 */
class SelectedMapObjectSelectionAttributeClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
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
        return $this->request(vsprintf('selection/%s/attribute/%s', $this->selectedId), 'PATCH',
            $data);
    }
}
