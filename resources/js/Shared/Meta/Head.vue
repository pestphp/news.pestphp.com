<template>
  <InertiaHead :title="pageTitle"></InertiaHead>
</template>

<script>
import {Head as InertiaHead} from "@inertiajs/inertia-vue3"

export default {
    name: "Head",
    components: {InertiaHead},
    props: {
        title: {
            type: String,
            default: null,
        }
    },
    computed: {
        pageTitle() {
            return `${this.title || this.$page.component} | Pest PHP News`
        }
    },
}
</script>
