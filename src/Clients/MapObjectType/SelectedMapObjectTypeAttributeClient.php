<?php

namespace Iza\Datacentralisatie\Clients\MapObjectType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\DefaultAttribute;

/**
 * Class SelectedMapObjectTypeAttributeClient
 * @package Iza\Datacentralisatie\Clients\Action
 */
class SelectedMapObjectTypeAttributeClient extends NestedClient
{
    use DefaultAttribute;

    /**
     * @param $id
     * @param array $include
     * @return mixed|void
     * @throws NotImplementedException
     */
    public function byId($id, $include = [])
    {
        if($this->defaultAttribute){
            $this->addParameter('default', $this->defaultAttribute);
        }
        return $this->request(vsprintf('type/%s/attribute/%s', $this->selectedId), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function postDefault($data)
    {
        return $this->request(vsprintf('type/%s/attribute/%s/default', $this->selectedId), 'POST', $data);
    }
}
