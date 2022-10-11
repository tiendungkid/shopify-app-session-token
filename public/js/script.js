class Uppromote {
    constructor() {
        this.root = document.getElementById('app')
        this.loginButton = document.getElementById('open-app')
        this.shop = this.root.dataset.shop
        this.addEventListener()
    }

    addEventListener() {
        this.loginButton.addEventListener('click', () => {
            axios.post('https://secomapp-affiliate.test/api/v1/login-app',
                {
                    shop_url: this.shop,
                },
                {
                    headers: {
                        'api-key': 'ygdUqNaGzhyn5636',
                        'user-name': 'embed_app',
                        'shopify-authenticate': `Bearer ${window.sessionToken}`,
                        'shop-url': this.shop,
                    },
                })
                .then(function(response) {
                    console.log(response)
                })
                .catch(function(error) {
                    console.log(error)
                })
        })
    }
}

new Uppromote()
