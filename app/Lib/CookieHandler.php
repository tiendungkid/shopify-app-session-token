<?php

declare(strict_types=1);

namespace App\Lib;

use Illuminate\Support\Facades\Cookie;
use Shopify\Auth\OAuthCookie;
use Shopify\Context;

class CookieHandler
{
    public static function saveShopifyCookie(OAuthCookie $cookie): bool
    {
        Cookie::queue(
            $cookie->getName(),
            $cookie->getValue(),
            $cookie->getExpire() ? ceil(($cookie->getExpire() - time()) / 60) : null,
            '/',
            Context::$HOST_NAME,
            $cookie->isSecure(),
            $cookie->isHttpOnly(),
            false,
            'Lax'
        );
        return true;
    }
}
