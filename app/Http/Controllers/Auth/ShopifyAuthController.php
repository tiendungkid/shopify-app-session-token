<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Lib\AppInstalledHandler;
use App\Lib\CookieHandler;
use Exception;
use Illuminate\Http\Request;
use Shopify\Auth\OAuth;
use Shopify\Context;
use Shopify\Exception\CookieSetException;
use Shopify\Exception\HttpRequestException;
use Shopify\Exception\InvalidOAuthException;
use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\OAuthCookieNotFoundException;
use Shopify\Exception\OAuthSessionNotFoundException;
use Shopify\Exception\PrivateAppException;
use Shopify\Exception\SessionStorageException;
use Shopify\Exception\UninitializedContextException;
use Shopify\Utils;

class ShopifyAuthController extends Controller
{
    /**
     * @throws CookieSetException
     * @throws UninitializedContextException
     * @throws PrivateAppException
     * @throws SessionStorageException
     */
    public function login(Request $request)
    {
        $shop = Utils::sanitizeShopDomain($request->get('shop'));
        if (!$request->hasCookie('shopify_top_level_oauth')) {
            return redirect()->route('login.toplevel', ['shop' => $shop]);
        }
        $installUrl = OAuth::begin(
            $shop,
            '/auth/callback',
            true,
            [CookieHandler::class, 'saveShopifyCookie']
        );
        return redirect($installUrl);
    }

    public function loginToplevel(Request $request)
    {
        $shop = Utils::sanitizeShopDomain($request->query('shop'));
        $apiKey = config('shopify.api_key');
        $hostName = config('shopify.host');
        return response(view('login-toplevel', compact('shop', 'apiKey', 'hostName')))
            ->withCookie(
                cookie()->forever(
                    'shopify_top_level_oauth',
                    '', null,
                    null,
                    true,
                    true,
                    false,
                    'strict'
                )
            );
    }

    /**
     * @throws OAuthSessionNotFoundException
     * @throws UninitializedContextException
     * @throws PrivateAppException
     * @throws SessionStorageException
     * @throws OAuthCookieNotFoundException
     * @throws HttpRequestException
     * @throws InvalidOAuthException
     */
    public function authCallback(Request $request)
    {
        $host = $request->query('host');
        $shop = Utils::sanitizeShopDomain($request->query('shop'));
        $apiKey = Context::$API_KEY;
        $session = OAuth::callback(
            $request->cookie(),
            $request->query(),
            [CookieHandler::class, 'saveShopifyCookie']
        );
        $handler = new AppInstalledHandler;
        $handler->installShop($shop, $session->getAccessToken());
        return redirect('?' . http_build_query(['host' => $host, 'shop' => $shop]));
    }

    /**
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function fallbackRoute(Request $request)
    {
        abort_if(!$request->query('shop'), 404);
        $shop = Utils::sanitizeShopDomain($request->query('shop'));
        $host = $request->query('host');
        $apiKey = Context::$API_KEY;
        $handler = new AppInstalledHandler;
        $installed = $handler->appInstalled($shop);
        $credentials = compact('shop', 'host', 'apiKey');
        $pageView = $handler->registered($shop)
            ? view('pages.dashboard', $credentials)
            : view('pages.register', $credentials);
        return $installed
            ? $pageView
            : redirect("/login?shop=$shop");
    }
}
