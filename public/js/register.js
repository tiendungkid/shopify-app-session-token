class Register {
	constructor() {
		this.registerButton = document.querySelector('button.btn-register')
	}

	init() {
		this.addEventListener()
	}

	addEventListener() {
		if (!this.registerButton) return
		this.registerButton.addEventListener('click', () => {
			this.registerButton.disabled = true
			const response = uppromote.fetchAndGetContent(
				`/api/auth/login?shop=${uppromote.shop}`,
				'POST',
				{
					shop: uppromote.shop,
					just_installed: 1,
				}
			)
			response.then((res) => this.redirectApp(res))
		})
	}

	redirectApp(response) {
		if (response.status === 'expired') {
			uppromote.reloadApp()
			return
		}
		const redirectUrl = new URL(response.redirect_url)
		redirectUrl.searchParams.set('session_token', window.sessionToken)
		try {
			redirect.dispatch(Redirect.Action.REMOTE, {
				url: redirectUrl.toString(),
				newContext: true,
			})
		} catch (e) {
			alert(
				`Unable to open the application. Please allow: Permissions for pop-ups and redirects in website setup`
			)
			console.error(e)
		}
		this.registerButton.disabled = false
	}
}

const register = new Register()
register.init()
