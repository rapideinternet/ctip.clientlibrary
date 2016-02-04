<?php

namespace Iza\Datacentralisatie\Clients\Type;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedTypeClient extends NestedClient
{
    use PerPage;

    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\Type\TypeActionClient::class,
        'attribute' => \Iza\Datacentralisatie\Clients\Type\TypeAttributeClient::class,
        'constraint' => \Iza\Datacentralisatie\Clients\Type\TypeConstraintClient::class,
        'dynamicActionType' => \Iza\Datacentralisatie\Clients\Type\TypeDynamicActionTypeClient::class,
        'status' => \Iza\Datacentralisatie\Clients\Type\TypeStatusClient::class,
    ];

    public function update($data)
    {
        return $this->request(vsprintf('type/%s', $this->selectedId), 'PATCH',
            json_encode($data))->getParsedResponse();
    }

    public function delete()
    {
        return $this->request(vsprintf('type/%s', $this->selectedId), 'DELETE')->getParsedResponse();
    }

    public function byId($id)
    {
        return $this->request(vsprintf('type/%s', $id), 'GET');
    }
}