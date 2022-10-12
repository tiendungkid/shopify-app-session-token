<?php

namespace App\Lib;

use App\Models\Auth\User;
use Exception;
use Secomapp\Models\Plan;
use Secomapp\Models\Shop;
use Secomapp\Traits\Authenticator;
use Secomapp\Traits\ChargeCreator;
use Secomapp\Traits\InstalledShop;
use Shopify\Clients\Graphql;
use Shopify\Exception\CookieSetException;
use Shopify\Exception\HttpRequestException;
use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\PrivateAppException;
use Shopify\Exception\SessionStorageException;
use Shopify\Exception\UninitializedContextException;

class AppInstalledHandler
{
    use InstalledShop, ChargeCreator, Authenticator {
        InstalledShop::clientApi insteadof ChargeCreator;
        InstalledShop::clientApi insteadof Authenticator;
        InstalledShop::shop insteadof ChargeCreator;
        InstalledShop::shop insteadof Authenticator;
        InstalledShop::shopPlan insteadof ChargeCreator;
        InstalledShop::shopPlan insteadof Authenticator;
        InstalledShop::shopId insteadof ChargeCreator;
        InstalledShop::shopId insteadof Authenticator;
        InstalledShop::shopName insteadof ChargeCreator;
        InstalledShop::shopName insteadof Authenticator;
        InstalledShop::pullThemeInfo insteadof ChargeCreator;
        InstalledShop::pullThemeInfo insteadof Authenticator;
        InstalledShop::homepage insteadof ChargeCreator;
        InstalledShop::homepage insteadof Authenticator;
        InstalledShop::hasSession insteadof ChargeCreator;
        InstalledShop::hasSession insteadof Authenticator;
        InstalledShop::initSession insteadof ChargeCreator;
        InstalledShop::initSession insteadof Authenticator;
        InstalledShop::hasAvailableCoupon insteadof ChargeCreator;
        InstalledShop::hasAvailableCoupon insteadof Authenticator;
    }

    public const TEST_GRAPHQL_QUERY = <<<QUERY
    {
        shop {
            name
        }
    }
    QUERY;

    /**
     * @throws CookieSetException
     * @throws UninitializedContextException
     * @throws PrivateAppException
     * @throws SessionStorageException
     */
    public function installShop(
        string $shop,
        string $accessToken
    )
    {
        /** @var Shop $shopModel */
        $shopModel = Shop::query()->where('shop', '=', $shop)->first();
        if ($shopModel) {
            if (!$shopModel->uninstalled()) $this->uninstallApp($shopModel);
            $shopModel->install($accessToken)->save();
        } else {
            $shopModel = Shop::query()->create([
                'shop' => $shop,
                'access_token' => $accessToken,
                'installed_at' => now(),
            ]);
        }
        // Save shop info
        $user = $this->findOrCreateUser($shopModel);
        $shopInfo = $this->getShopInfoAndSave($shopModel);
        $user->updateFromShopInfo($shopInfo)->save();
        auth()->login($user);
        // Subscribe default plan
        $shopModel->deactivate();
        $plan = Plan::find(2);
        $subscription = $shopModel->newSubscription($plan)->create();
        $shopModel->activate($subscription->starts_at)->save();
        if (!session('sudo', false)) {
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['layer' => 'app', 'shop' => $shopModel])
                ->log('free forever plan started');
        }
        // TODO: Register uninstall webhook
        // TODO: Trigger event AppInstalled
        // TODO: Dispatch PublishThemeJob
    }

    /**
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function appInstalled(string $shop): bool
    {
        /** @var Shop $shop */
        $shop = Shop::query()->where('shop', '=', $shop)->first();
        if (!$shop || $shop->uninstalled()) {
            return false;
        }
        return $this->simpleCheckAccessToken($shop);
    }

    /**
     * @param Shop $shop
     * @return bool
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    private function simpleCheckAccessToken(Shop $shop): bool
    {
        $client = new Graphql($shop->shop, $shop->access_token);
        $response = $client->query(self::TEST_GRAPHQL_QUERY);
        return $response->getStatusCode() === 200;
    }

    /**
     * @param $shop
     * @return User
     */
    protected function findOrCreateUser($shop): User
    {
        return User::firstOrCreate([
            'shop_id' => $shop->id,
            'shop_name' => shopNameFromDomain($shop->shop),
        ]);
    }

    public function getShopInfoAndSave(Shop $shop)
    {
        $clientApi = generateClientApi($shop);
        $shopApi = new \Secomapp\Resources\Shop($clientApi);
        try {
            $response = $shopApi->get();
            return $this->saveShopInfo($shop, $response);
        } catch (Exception $exception) {
            return false;
        }
    }

    private function uninstallApp(Shop $shop)
    {
        $shop->uninstall()->deactivate()->save();
        // TODO: Call uninstall listener api
    }
}
