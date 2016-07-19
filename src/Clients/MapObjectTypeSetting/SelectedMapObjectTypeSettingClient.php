<?php

namespace Iza\Datacentralisatie\Clients\MapObjectTypeSetting;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedMapObjectTypeClient
 * @package Iza\Datacentralisatie\Clients\MapObjectTypeSetting
 */
class SelectedMapObjectTypeSettingClient extends NestedClient
{
    protected $nestedObjects = [];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('type_setting/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('type_setting/%s', $this->selectedId), 'PATCH',
            $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('type_setting/%s', $this->selectedId), 'DELETE');
    }
}