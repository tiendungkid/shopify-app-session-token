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
				this.onGetLinkButtonClicked(btn)
			})
		})
	}

	onGetLinkButtonClicked(btn) {
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
			.then((res) => this.redirectApp(res, btn))
	}

	redirectApp(response, button) {
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
		button.disabled = false
	}
}

const register = new Dashboard()
register.initialize()
