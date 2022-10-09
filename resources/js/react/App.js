import React from 'react';
import ReactDOM from 'react-dom';
import createApp from "@shopify/app-bridge";
import {getSessionToken} from '@shopify/app-bridge-utils';

function App({shop, host, apiKey}) {
    const config = {apiKey: apiKey, shopOrigin: shop, host: host, forceRedirect: true}

    return (
        <div>
            Hello bae!
        </div>
    );
}

export default App;

const root = document.getElementById('app')
if (root) {
    const app = createApp({
        apiKey: root.dataset.apiKey
    })
    ReactDOM.render(<App {...(root.dataset)}/>, root)
}
