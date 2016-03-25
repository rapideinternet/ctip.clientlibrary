<?php

namespace Iza\Datacentralisatie\Clients\MapObject;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MapObjectImageClient extends NestedClient
{
    public function all($include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('object/%s/image', $this->selectedId));
    }

    public function byId($id, $include = [])
    {
        return $this->all($include);
    }

    public function create(UploadedFile $file)
    {
        return $this->fileRequest(vsprintf('object/%s/image', $this->selectedId), $file);
    }

    public function update($data)
    {
        throw new NotImplementedException;
    }

    public function delete($data)
    {
        throw new NotImplementedException;
    }
}
