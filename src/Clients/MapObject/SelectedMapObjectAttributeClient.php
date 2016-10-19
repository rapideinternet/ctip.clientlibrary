<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\DefaultAttribute;

/**
 * Class SelectedMapObjectAttributeClient
 * @package Iza\Datacentralisatie\Clients\MapObject
 */
class SelectedMapObjectAttributeClient extends NestedClient
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
        return $this->request(vsprintf('object/%s/attribute/%s', $this->selectedId), 'GET');
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
