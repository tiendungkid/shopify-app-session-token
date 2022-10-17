class Dashboard {
	constructor() {
		this.registerButton = [
			...document.querySelectorAll('button.btn-redirect'),
		]
	}

	initialize() {
		this.addEventListener()
	}

	addEventListener() {
		this.registerButton.forEach((btn) => {
			btn.addEventListener('click', () => {
				btn.disabled = true
				uppromote
					.fetchAndGetContent(
						`/api/auth/login?shop=${uppromote.shop}`,
						'POST',
						{
							shop: uppromote.shop,
							redirect_url: btn.dataset.redirectUrl,
						}
					)
					.then((res) => {
						const redirectUrl = new URL(res.redirect_url)
						redirectUrl.searchParams.set(
							'session_token',
							window.sessionToken
						)
						window.open(redirectUrl.toString())
						btn.disabled = false
					})
			})
		})
	}
}

const register = new Dashboard()
register.initialize()
