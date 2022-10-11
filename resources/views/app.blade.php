<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <script src="https://unpkg.com/@shopify/app-bridge@3"></script>
    <script src="https://unpkg.com/@shopify/app-bridge-utils@3"></script>
</head>
<body>
<div id="app" data-shop="{{ $shop }}" data-api-key="{{ $apiKey }}" data-host="{{ $host }}">
    App loading ...
</div>
<script>
    const root = document.getElementById('app')
    const {host, apiKey} = root.dataset
    const AppBridge = window['app-bridge']
    const AppBridgeUtils = window['app-bridge-utils']
    const createApp = AppBridge.default
    const app = createApp({apiKey, host, forceRedirect: true})

    async function getSessionToken(app) {
        return await AppBridgeUtils.getSessionToken(app)
    }

    getSessionToken(app).then(res => {
        window.sessionToken = res
    })

    setInterval(() => {
        getSessionToken(app).then(res => {
            window.sessionToken = res
        })
    }, 3e4)
</script>
</body>
