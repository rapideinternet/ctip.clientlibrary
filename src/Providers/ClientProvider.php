<?php

namespace Iza\Datacentralisatie\Providers;

class ClientProvider
{
    public function clients()
    {
        return [
            'action' => \Iza\Datacentralisatie\Clients\Action\ActionClient::class,
            'actionImageType' => \Iza\Datacentralisatie\Clients\ActionImageType\ActionImageTypeClient::class,
            'actionPriority' => \Iza\Datacentralisatie\Clients\ActionPriority\ActionPriorityClient::class,
            'actionStatus' => \Iza\Datacentralisatie\Clients\ActionStatus\ActionStatusClient::class,
            'attribute' => \Iza\Datacentralisatie\Clients\Attribute\AttributeClient::class,
            'attributeGroup' => \Iza\Datacentralisatie\Clients\AttributeGroup\AttributeGroupClient::class,
            'auth' => \Iza\Datacentralisatie\Clients\AuthClient::class,
            'dynamicActionType' => \Iza\Datacentralisatie\Clients\DynamicActionType\DynamicActionTypeClient::class,
            'dynamicActionTypeCategory' => \Iza\Datacentralisatie\Clients\DynamicActionTypeCategory\DynamicActionTypeCategoryClient::class,
            'category' => \Iza\Datacentralisatie\Clients\MapObjectCategory\CategoryClient::class,
            'comment' => \Iza\Datacentralisatie\Clients\Comment\CommentClient::class,
            'country' => \Iza\Datacentralisatie\Clients\Country\CountryClient::class,
            'geoAttribute' => \Iza\Datacentralisatie\Clients\GeoAttribute\GeoAttributeClient::class,
            'geoObject' => \Iza\Datacentralisatie\Clients\GeoObject\GeoObjectClient::class,
            'mapObjectStatus' => \Iza\Datacentralisatie\Clients\MapObjectStatus\MapObjectStatusClient::class,
            'me' => \Iza\Datacentralisatie\Clients\Me\MeClient::class,
            'object' => \Iza\Datacentralisatie\Clients\MapObject\MapObjectClient::class,
            'role' => \Iza\Datacentralisatie\Clients\Role\RoleClient::class,
            'selection' => \Iza\Datacentralisatie\Clients\MapObjectSelection\MapObjectSelectionClient::class,
            'selectionType' => \Iza\Datacentralisatie\Clients\MapObjectSelectionType\MapObjectSelectionTypeClient::class,
            'tenant' => \Iza\Datacentralisatie\Clients\Tenant\TenantClient::class,
            'type' => \Iza\Datacentralisatie\Clients\MapObjectType\MapObjectTypeClient::class,
            'user' => \Iza\Datacentralisatie\Clients\User\UserClient::class,
        ];
    }
}
