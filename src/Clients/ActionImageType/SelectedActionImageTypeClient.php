<?php

namespace Iza\Datacentralisatie\Clients\ActionImageType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedActionImageTypeClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\ActionImageType\ActionImageTypeDynamicActionTypeClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('action_image_type/%s', $this->selectedId), 'PATCH',
            $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('action_image_type/%s', $this->selectedId), 'DELETE');
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('action_image_type/%s', $id), 'GET');
    }
}
