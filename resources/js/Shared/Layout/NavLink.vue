<template>
    <li>
        <component :is="page ? 'InertiaLink' : 'a'"
                   :href="href"
                   :class="{'font-bold bg-gradient-to-b from-pest-pink to-pest-green': isActive}"
                   class="text-lg bg-clip-text text-transparent bg-gray-500 hover:bg-gray-800 flex items-center group">
            <slot/>
            <ExternalLinkIcon v-if="page === null" class="ml-2 w-4 h-4 text-gray-500 group-hover:text-gray-800"/>
        </component>
    </li>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3"
import {ExternalLinkIcon} from "@heroicons/vue/solid"

export default {
    name: "NavLink",
    components: {InertiaLink, ExternalLinkIcon},
    props: {
        href: {
            type: String,
            default: '#',
        },
        page: {
            type: String,
            default: null,
        }
    },
    computed: {
        isActive() {
            return this.$page.component === this.page
        }
    }
}
</script>
