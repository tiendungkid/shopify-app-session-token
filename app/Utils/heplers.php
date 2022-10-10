<?php

use Secomapp\Contracts\ClientApiContract;
use Secomapp\Models\Shop;

if (!function_exists('generateClientApi')) {
    /**
     * Generate client api
     * @param Shop $shop
     * @return ClientApiContract
     */
    function generateClientApi(Shop $shop): ClientApiContract
    {
        /** @var ClientApiContract $client */
        $client = app(ClientApiContract::class);
        $client->setAccessToken($shop->access_token);
        $client->setShopName(shopNameFromDomain($shop->shop));
        return $client;
    }
}
