<?php
return [
    'api_key' => env('SHOPIFY_API_KEY'),
    'secret_key' => env('SHOPIFY_API_SECRET'),
    'scopes' => explode(',', env('SCOPES')),
    'host' => env('HOST'),
    'rest_api_version' => env('SHOPIFY_REST_API_VERSION', '2022-10'),
    'graph_api_version' => env('SHOPIFY_GRAPH_API_VERSION', '2022-10'),
];
