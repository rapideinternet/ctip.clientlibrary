<?php

namespace Iza\Datacentralisatie\Clients\Team;

use Iza\Datacentralisatie\Clients\NestedClient;

/**
 * Class SelectedTeamClient
 * @package Iza\Datacentralisatie\Clients\Tenant
 */
class SelectedTeamClient extends NestedClient
{
    protected $nestedObjects = [
        'user' => \Iza\Datacentralisatie\Clients\Team\TeamUserClient::class,
    ];

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function byId($id, $include = [])
    {
        $this->addParameter('include', implode(',', $include));

        return $this->request(vsprintf('team/%s', $id), 'GET');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->request(vsprintf('team/%s', $this->selectedId), 'PATCH', $data);
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->request(vsprintf('team/%s', $this->selectedId), 'DELETE');
    }
}