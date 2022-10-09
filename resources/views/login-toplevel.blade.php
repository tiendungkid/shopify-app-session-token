<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <script src="https://unpkg.com/@shopify/app-bridge@3"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.top === window.self) {
                window.location.href = '/login?shop={{ $shop }}';
            } else {
                const AppBridge = window['app-bridge'];
                const createApp = AppBridge.default;
                const Redirect = AppBridge.actions.Redirect;

                const app = createApp({
                    apiKey: `{{ $apiKey }}`,
                    shopOrigin: `{{ $shop }}`,
                });

                const redirect = Redirect.create(app);
                redirect.dispatch(Redirect.Action.REMOTE, 'https://{{ $hostName }}/login/toplevel?shop={{ $shop }}');
            }
        });
    </script>
</head>
<body>
</body>
</html>
