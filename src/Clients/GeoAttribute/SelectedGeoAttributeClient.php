<?php

namespace Iza\Datacentralisatie\Clients\GeoAttribute;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedGeoAttributeClient extends NestedClient
{
    use PerPage;

    public function byId($id)
    {
        return $this->request(vsprintf('geo_attribute/%s', $id), 'GET');
    }
}
