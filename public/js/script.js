class Uppromote {
	constructor({ shop, apiKey, host }) {
		this.shop = shop
		this.apiKey = apiKey
		this.host = host
	}

	initialize() {
		this.addEventListener()
	}

	addEventListener() {
		const openAppButton = document.getElementById('open-app')
		openAppButton.addEventListener('click', () => {
			const response = this.fetchAndGetContent(
				'/api/auth/login',
				'POST',
				{}
			)
			response.then((res) => {
				const data = JSON.parse(res.data)
				window.open(data.redirect_url)
			})
		})
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
}

const appRoot = document.getElementById('app')
const uppromote = new Uppromote({ ...appRoot.dataset })
uppromote.initialize()
