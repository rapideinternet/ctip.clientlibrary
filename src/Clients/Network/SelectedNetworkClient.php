<?php

namespace Iza\Datacentralisatie\Clients\Network;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedNetworkClient
 * @package Iza\Datacentralisatie\Clients\Network
 */
class SelectedNetworkClient extends NestedClient
{
    protected $nestedObjects = [
        'action' => \Iza\Datacentralisatie\Clients\Network\NetworkActionClient::class,
        'actionAttributeValues' => \Iza\Datacentralisatie\Clients\Network\NetworkActionAttributeValuesClient::class,
        'children' => \Iza\Datacentralisatie\Clients\Network\NetworkChildrenClient::class,
        'map_object' => \Iza\Datacentralisatie\Clients\Network\NetworkMapObjectClient::class,
        'map_object_selection' => \Iza\Datacentralisatie\Clients\Network\NetworkMapObjectSelectionClient::class,
        'productActions' => \Iza\Datacentralisatie\Clients\Network\NetworkProductActionsClient::class,
        'productObjects' => \Iza\Datacentralisatie\Clients\Network\NetworkProductObjectsClient::class,
        'user' => \Iza\Datacentralisatie\Clients\Network\NetworkUserClient::class,
    ];


    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('network/%s', $id), 'GET');
    }

}
