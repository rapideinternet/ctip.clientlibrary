<?php

namespace Iza\Datacentralisatie\Clients\AttributeGroup;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedAttributeGroupClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'attribute' => \Iza\Datacentralisatie\Clients\AttributeGroup\AttributeGroupAttributeClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('attribute_group/%s', $this->selectedId), 'PATCH',
            $data);
    }

    public function delete()
    {
        return $this->request(vsprintf('attribute_group/%s', $this->selectedId), 'DELETE');
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('attribute_group/%s', $id), 'GET');
    }
}
