<?php

namespace Iza\Datacentralisatie\Clients\Action;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class ActionImageClient extends NestedClient
{
    public function all($include = [], $filter = [])
    {
        throw new NotImplementedException;
    }

    public function byId($id, $include = [])
    {
        throw new NotImplementedException;
    }

    public function create($data)
    {
        throw new NotImplementedException;
    }

    public function delete($data)
    {
        throw new NotImplementedException;
    }
}
