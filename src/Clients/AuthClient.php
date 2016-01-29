<?php

namespace Iza\Datacentralisatie\Clients;

use Iza\Datacentralisatie\IDatacentralisatieClient;

class AuthClient extends BaseClient
{
    public function login()
    {
        $credentials = $this->client->getCredentials();

        $data = [
            'email' => $credentials[IDatacentralisatieClient::EMAIL],
            'password' => $credentials[IDatacentralisatieClient::PASSWORD]
        ];

        if (isset($credentials[IDatacentralisatieClient::TENANT_ID])) {
            $data['tenant_id'] = $credentials[IDatacentralisatieClient::TENANT_ID];
        }

        return $this->request('/auth', 'POST', $data);
    }
}