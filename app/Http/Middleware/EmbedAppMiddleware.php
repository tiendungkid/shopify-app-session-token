<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EmbedAppMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return JsonResponse|RedirectResponse|Response|BinaryFileResponse|StreamedResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if ($response instanceof StreamedResponse ||
            $response instanceof BinaryFileResponse ||
            $response instanceof JsonResponse
        ) {
            return $response;
        }

        $domain = $request->query('shop');
        if (isValidDomain($domain)) {
            $response->header('Content-Security-Policy', "frame-ancestors https://{$domain} https://admin.shopify.com;");
        } else {
            $response->header('Content-Security-Policy', "frame-ancestors none;");
        }

        return $response;
    }
}
