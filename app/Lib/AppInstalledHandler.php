<?php

namespace App\Lib;

use App\Models\Auth\Shop;

class AppInstalledHandler
{
    public function saveShopInstallInfo(
        string $shop,
        string $accessToken
    )
    {
        return Shop::query()->updateOrCreate(
            ['shop' => $shop],
            ['access_token' => $accessToken]
        );
    }
}
