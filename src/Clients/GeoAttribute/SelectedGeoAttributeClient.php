<?php

namespace Iza\Datacentralisatie\Clients\GeoAttribute;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedGeoAttributeClient
 * @package Iza\Datacentralisatie\Clients\GeoAttribute
 */
class SelectedGeoAttributeClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('geo_attribute/%s', $id), 'GET');
    }
}
