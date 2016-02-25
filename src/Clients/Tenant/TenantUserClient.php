<?php

namespace Iza\Datacentralisatie\Clients\Tenant;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Traits\PerPage;

class TenantUserClient extends NestedClient
{
    use PerPage;

    public function __construct($client, $id)
    {
        parent::__construct($client, $id);

    }


    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));
        $this->addParameter('perPage', $this->perPage);

        return $this->request(vsprintf('tenant/%s/user', $this->selectedId));
    }
}