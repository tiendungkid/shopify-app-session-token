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
<div id="app" data-shop="{{ $shop }}" data-api-key="{{ $apiKey }}" data-host="{{ $host }}" data-shop-origin="{{ $shop }}"></div>
@yield('content')
@include('includes.app-bridge')
@include('includes.script')
</body>
