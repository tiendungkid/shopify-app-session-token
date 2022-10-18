class Uppromote {
	constructor({ shop, host }) {
		this.shop = shop
		this.host = host
	}

	initialize() {
		console.log(`> UpPromote - Affiliate Marketing: initialize`)
	}

	/**
	 * Fetch content
	 * @param url
	 * @param method
	 * @param body
	 * @returns {Promise<null>}
	 */
	async fetchAndGetContent(url = '', method = 'GET', body = {}) {
		if (['GET', 'HEAD'].includes(method)) {
			const getUrl = new URL(url)
			const bodyParams = new URLSearchParams(body)
			const urlParams = url.searchParams
			const allParameters = new URLSearchParams({
				...Object.fromEntries(bodyParams),
				...Object.fromEntries(urlParams),
			})
			const response = await fetch(
				`${getUrl.origin}${getUrl.pathname}?${allParameters.toString()}`
			)
			return (await response.json()) || null
		}
		const formData = new FormData()
		Object.keys(body).forEach((key) => formData.append(key, body[key]))
		const response = await fetch(url, {
			method,
			headers: {
				Authorization: `Bearer ${window.sessionToken}`,
			},
			body: formData,
		})
		return (await response.json()) || null
	}

	reloadApp() {
		redirect.dispatch(Redirect.Action.APP, {
			path: `/login?shop=${this.shop}`,
		})
	}
}

const appRoot = document.getElementById('app')
const uppromote = new Uppromote({ ...appRoot.dataset })
uppromote.initialize()
