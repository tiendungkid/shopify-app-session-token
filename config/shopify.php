<?php
return [
    'api_key' => env('SHOPIFY_API_KEY'),
    'shared_secret' => env('SHOPIFY_SHARED_SECRET'),
    'scopes' => explode(',', env('SCOPES')),
    'host' => env('HOST'),
    'rest_api_version' => env('SHOPIFY_REST_API_VERSION', '2022-10'),
    'graph_api_version' => env('SHOPIFY_GRAPH_API_VERSION', '2022-10'),
    'api_version' => env('SHOPIFY_REST_API_VERSION', '2022-01'),


    'redirect_url' => env('SHOPIFY_REDIRECT_URL'),
    'permissions' => [
        env('SCOPES')
    ],
    'admin_shop_names' => explode(',', env('ADMIN_SHOP_NAMES')),
    'remove_days' => 30,
    'remove_attributes' => [
        'address1' => null,
        'address2' => null,
        'customer_email' => null,
        'email' => null,
        'phone' => null,
        'latitude' => null,
        'longitude' => null,
        'shop_owner' => null,
        'description' => '',
    ],
    'react_non_eu' => env('REDACT_NON_EU', true)
];
