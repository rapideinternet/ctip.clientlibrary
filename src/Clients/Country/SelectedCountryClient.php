<?php

namespace Iza\Datacentralisatie\Clients\Country;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedCountryClient extends NestedClient
{
    use PerPage;

    public function byId($id)
    {
        return $this->request(vsprintf('country/%s', $id), 'GET');
    }
}
