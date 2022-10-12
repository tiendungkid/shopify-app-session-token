<?php

namespace App\Providers;

use App\Lib\DbSessionStorage;
use Illuminate\Support\ServiceProvider;
use Secomapp\ClientApi;
use Secomapp\Contracts\ClientApiContract;
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
        $this->app->bind(ClientApiContract::class, function () {
            return $this->clientApi();
        });
    }

    /**
     * @return ClientApiContract
     */
    protected function clientApi()
    {
        $clientApi = session('client_api');
        if (!$clientApi) {
            $clientApi = new ClientApi(config('shopify.shared_secret'), config('shopify.api_version'));
            session(['client_api' => $clientApi]);
        }

        return $clientApi;
    }
}
