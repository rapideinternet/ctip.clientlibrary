<?php

namespace Iza\Datacentralisatie\Providers;

class ClientProvider
{
    public function clients()
    {

        return [
            'object' => \Iza\Datacentralisatie\Clients\ObjectClient::class
        ];

    }
}