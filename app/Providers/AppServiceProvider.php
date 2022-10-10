<?php

namespace App\Providers;

use App\Lib\DbSessionStorage;
use Illuminate\Support\ServiceProvider;
use Shopify\Context;
use Shopify\Exception\MissingArgumentException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     * @return void
     * @throws MissingArgumentException
     */
    public function boot()
    {
        Context::initialize(
            config('shopify.api_key'),
            config('shopify.shared_secret'),
            config('shopify.scopes'),
            str_replace('https://', '', config('shopify.host')),
            new DbSessionStorage()
        );
    }
}
