import {createApp, h} from 'vue'
import {createInertiaApp} from '@inertiajs/inertia-vue3'
import {ZiggyVue} from 'ziggy'
import {InertiaProgress} from "@inertiajs/progress";
import Layout from "./Shared/Layout/Layout";

createInertiaApp({
    resolve: name => {
        const page = require(`./Pages/${name}`).default
        page.layout ??= Layout

        return page
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)
    },
})

InertiaProgress.init()

