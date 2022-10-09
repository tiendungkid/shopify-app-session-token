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
    setTimeout(function () {
        const root = document.getElementById('app')
        if (root) {
            const {host, apiKey} = root.dataset;
            const AppBridge = window['app-bridge'];
            const createApp = AppBridge.default;
            const app = createApp({apiKey, host});
        }
    }, 2e3)
</script>
</body>
