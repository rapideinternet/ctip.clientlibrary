<?php

namespace Iza\Datacentralisatie\Clients\Network;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedNetworkClient extends NestedClient
{
    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\Network\NetworkActionClient::class,
        'actionAttributeValues' => \Iza\Datacentralisatie\Clients\Network\NetworkActionAttributeValuesClient::class,
        'children' => \Iza\Datacentralisatie\Clients\Network\NetworkChildrenClient::class
    ];

    public function byId($id, $include = [])
    {
        throw new NotImplementedException;
    }

}
