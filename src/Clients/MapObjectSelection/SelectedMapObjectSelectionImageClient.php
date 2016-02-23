<?php

namespace Iza\Datacentralisatie\Clients\MapObjectSelection;

use Iza\Datacentralisatie\Clients\NestedClient;
use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\Exceptions\Exception;
use Iza\Datacentralisatie\Exceptions\NotImplementedException;
use Iza\Datacentralisatie\Traits\PerPage;

class SelectedMapObjectSelectionImageClient extends NestedClient
{
    use PerPage;

    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('selection/%s/image/%s', $this->selectedId), 'GET');
    }

    public function update($data)
    {
        return $this->request(vsprintf('selection/%s/image/%s', $this->selectedId), 'PATCH',
            $data)->getParsedResponse();
    }

    public function delete()
    {
        return $this->request(vsprintf('selection/%s/image/%s', $this->selectedId), 'DELETE')->getParsedResponse();
    }
}
