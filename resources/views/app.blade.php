<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <script src="https://unpkg.com/@shopify/app-bridge@3"></script>
    <script src="https://unpkg.com/@shopify/app-bridge-utils@3"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    @yield('head')
</head>
<body>
<div id="app" data-shop="{{ $shop }}" data-api-key="{{ $apiKey }}" data-host="{{ $host }}"
     data-shop-origin="{{ $shop }}">
</div>
@yield('content')
@include('includes.app-bridge')
@include('includes.script')
@yield('footer')
</body>
