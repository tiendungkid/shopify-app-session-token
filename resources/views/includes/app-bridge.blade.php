<script>
    const root = document.getElementById('app')
    const {host, apiKey, shopOrigin} = root.dataset
    const AppBridge = window['app-bridge']
    const AppBridgeUtils = window['app-bridge-utils']
    const createApp = AppBridge.default
    const app = createApp({apiKey, host})

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
