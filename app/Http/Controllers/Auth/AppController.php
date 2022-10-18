<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Secomapp\Models\Shop;
use Shopify\Exception\CookieNotFoundException;
use Shopify\Exception\MissingArgumentException;
use Shopify\Utils;

class AppController extends Controller
{
    private string $apiKey;

    public function __construct()
    {
        // Replace by config
        $this->apiKey = 'ygdUqNaGzhyn5636';
    }

    /**
     * @throws CookieNotFoundException
     * @throws MissingArgumentException
     * @throws GuzzleException
     */
    public function login(Request $request)
    {
        info('111');
        $session = Utils::loadCurrentSession($request->header(), $request->cookie(), 'online');
        if ($request->get('just_installed', 0) == 1) {
            return $this->register(
                $session->getShop(),
                str_replace('Bearer ', '', $request->header('Authorization', ''))
            );
        }
        try {
            $redirectUrl = $request->get('redirect_url', '/admin');
            $client = new Client([
                'allow_redirects' => false,
                'verify' => false,
                RequestOptions::HEADERS => [
                    'Api-Key' => $this->apiKey,
                    'User-Name' => 'embed_app',
                    'Shopify-Authenticate' => str_replace('Bearer ', '', $request->header('Authorization', '')),
                    'Shop-Url' => $session->getShop()
                ],
                json_encode([
                    'shop_url' => $session->getShop(),
                    'redirect_url' => $redirectUrl
                ])
            ]);
            $response = $client->post(
                config('shopify.uppromote_app_url') . '/api/v1/login-app',
                [
                    RequestOptions::JSON => [
                        'shop_url' => $session->getShop(),
                        'redirect_url' => urlencode($redirectUrl)
                    ]
                ]
            );
            $data = json_decode($response->getBody()->getContents());
            return response()->json($data);
        } catch (Exception $exception) {
            logger()->error('Post login failed: ' . $exception->getMessage());
            return response()->json([]);
        }
    }

    public function register($shop, $sessionToken)
    {
        $emptyResponse = response()->json([]);
        try {
            $shopModel = Shop::findByDomain($shop)->first();
            if (!$shopModel) return $emptyResponse;
            $user = User::where('shop_id', '=', $shopModel->id)->first();
            if (!$user) return $emptyResponse;
            $client = new Client(['allow_redirects' => false, 'verify' => false,
                RequestOptions::HEADERS => [
                    'Api-Key' => $this->apiKey,
                    'User-Name' => 'embed_app',
                    'Shopify-Authenticate' => str_replace('Bearer ', '', $sessionToken),
                    'Shop-Url' => $shop
                ]
            ]);
            $response = $client->post(config('shopify.uppromote_app_url') . '/api/v1/authorize-app', [
                RequestOptions::JSON => ['user_id' => $user->id]
            ]);
            $data = json_decode($response->getBody()->getContents());
            return response()->json($data);
        } catch (GuzzleException $e) {
            logger()->error('Cant post register shop: ' . $e->getMessage());
        }
        return $emptyResponse;
    }
}
