<?php

namespace Iza\Datacentralisatie\Clients;

use Iza\Datacentralisatie\DatacentralisatieClient;
use Iza\Datacentralisatie\IDatacentralisatieClient;

/**
 * Class AuthClient
 * @package Iza\Datacentralisatie\Clients
 */
class AuthClient extends BaseClient
{
    /**
     * @param DatacentralisatieClient $client
     */
    public function __construct(DatacentralisatieClient $client)
    {
        parent::__construct($client);
        $this->setRaw();
    }

    /**
     * @return mixed
     */
    public function login()
    {
        $credentials = $this->client->getCredentials();

        $data = [
            'username' => $credentials[IDatacentralisatieClient::USERNAME],
            'password' => $credentials[IDatacentralisatieClient::PASSWORD],
            'grant_type' => 'password',
            'client_id' => $credentials[IDatacentralisatieClient::CLIENT_ID],
            'client_secret' => $credentials[IDatacentralisatieClient::CLIENT_SECRET]
        ];

        return $this->request('oauth/access_token', 'POST', $data);
    }

    public function refresh()
    {
        $credentials = $this->client->getCredentials();

        $data = [
            'refresh_token' => $credentials[IDatacentralisatieClient::REFRESH_TOKEN],
            'grant_type' => 'refresh_token',
            'client_id' => $credentials[IDatacentralisatieClient::CLIENT_ID],
            'client_secret' => $credentials[IDatacentralisatieClient::CLIENT_SECRET]
        ];

        return $this->request('oauth/access_token', 'POST', $data);
    }
}