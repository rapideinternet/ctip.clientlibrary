<?php

namespace Iza\Datacentralisatie\Providers;

class ClientProvider
{
    public function clients()
    {
        return [
            'action' => \Iza\Datacentralisatie\Clients\Action\ActionClient::class,
            'auth' => \Iza\Datacentralisatie\Clients\AuthClient::class,
            'dynamicActionType' => \Iza\Datacentralisatie\Clients\DynamicActionType\DynamicActionTypeClient::class,
            'me' => \Iza\Datacentralisatie\Clients\Me\MeClient::class,
            'object' => \Iza\Datacentralisatie\Clients\Object\ObjectClient::class,
            'tenant' => \Iza\Datacentralisatie\Clients\Tenant\TenantClient::class,
            'type' => \Iza\Datacentralisatie\Clients\Type\TypeClient::class,
            'user' => \Iza\Datacentralisatie\Clients\User\UserClient::class,
        ];
    }
}
