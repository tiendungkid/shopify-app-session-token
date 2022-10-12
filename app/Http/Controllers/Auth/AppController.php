<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Shopify\Exception\CookieNotFoundException;
use Shopify\Exception\MissingArgumentException;
use Shopify\Utils;

class AppController extends Controller
{
    /**
     * @throws CookieNotFoundException
     * @throws MissingArgumentException
     * @throws GuzzleException
     */
    public function login(Request $request)
    {
        $session = Utils::loadCurrentSession($request->header(), $request->cookie(), 'online');
        $client = new Client([
            'allow_redirects' => false,
            'verify' => false,
            RequestOptions::HEADERS => [
                'Api-Key' => 'ygdUqNaGzhyn5636',
                'User-Name' => 'embed_app',
                'Shopify-Authenticate' => str_replace('Bearer ', '', $request->header('Authorization', '')),
                'Shop-Url' => $session->getShop()
            ]
        ]);
        $response = $client->post(config('shopify.uppromote_app_url') . '/api/v1/login-app',
            [RequestOptions::JSON => ['shop_url' => $session->getShop()]]);
        $data = $response->getBody()->getContents();
        return response()->json(compact('data'));
    }
}
