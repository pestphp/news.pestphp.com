import {createApp, h} from 'vue'
import {createInertiaApp} from '@inertiajs/inertia-vue3'
import {ZiggyVue} from 'ziggy'
import {InertiaProgress} from "@inertiajs/progress";
import Layout from "./Shared/Layout/Layout";
import axios from "axios";

const handleAxiosError = (error, app) => {
    // Too many requests
    if (error.response.status === 429) {
        app.$page.props.flash.message = 'Whoa, slow down a little! Try again in a minute.'
    }
}

createInertiaApp({
    resolve: name => {
        const page = require(`./Pages/${name}`).default
        page.layout ??= Layout

        return page
    },
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)

        axios.interceptors.response.use(
            response => response,
            error => handleAxiosError(error, app)
        )
    },
})

InertiaProgress.init()

