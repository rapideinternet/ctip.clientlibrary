<?php

namespace Iza\Datacentralisatie\Clients\DynamicActionTypeCategory;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedDynamicActionTypeCategoryClient extends NestedClient
{
    protected $nestedObjects = [
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\DynamicActionTypeCategory\DynamicActionTypeCategoryDynamicActionTypeClient::class,
    ];

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('dynamic_action_type_category/%s', $id), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('dynamic_action_type_category/%s', $this->selectedId), 'PATCH',
            $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('dynamic_action_type_category/%s', $this->selectedId), 'DELETE');
    }
}
