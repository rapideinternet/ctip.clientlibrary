<?php

namespace Iza\Datacentralisatie\Providers;

class ClientProvider
{
    public function clients()
    {

        return [
            'object' => \Iza\Datacentralisatie\Clients\Object\ObjectClient::class,
            'user' => \Iza\Datacentralisatie\Clients\User\UserClient::class,
            'tenant' => \Iza\Datacentralisatie\Clients\Tenant\TenantClient::class,
            'auth' => \Iza\Datacentralisatie\Clients\AuthClient::class,
            'me' => \Iza\Datacentralisatie\Clients\Me\MeClient::class
        ];

    }
}