<?php

namespace Iza\Datacentralisatie\Clients\Country;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;

/**
 * Class SelectedCountryClient
 * @package Iza\Datacentralisatie\Clients\Country
 */
class SelectedCountryClient extends NestedClient
{
    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('country/%s', $id), 'GET');
    }
}
