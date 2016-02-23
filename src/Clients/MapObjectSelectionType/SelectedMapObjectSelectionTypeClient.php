<?php

namespace Iza\Datacentralisatie\Clients\MapObjectSelectionType;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedMapObjectSelectionTypeClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'attribute' => \Iza\Datacentralisatie\Clients\MapObjectSelectionType\MapObjectSelectionTypeAttributeClient::class,
        'selection' => \Iza\Datacentralisatie\Clients\MapObjectSelectionType\MapObjectSelectionTypeSelectionClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('selection_types/%s', $this->selectedId), 'PATCH', $data)->getParsedResponse();
    }

    public function delete($data)
    {
        return $this->request(vsprintf('selection_types/%s', $this->selectedId), 'DELETE', $data)->getParsedResponse();
    }

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('selection_types/%s', $id), 'GET');
    }
}