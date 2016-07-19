<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;

/**
 * Class SelectedActionAttributeClient
 * @package Iza\Datacentralisatie\Clients\Action
 */
class SelectedActionAttributeClient extends NestedClient
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
        return $this->request(vsprintf('action/%s/attribute/%s', $this->selectedId), 'PATCH',
            $data);
    }
}
