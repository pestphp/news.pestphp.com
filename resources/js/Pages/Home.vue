<template>
    <Head></Head>
    <Link :href="route('home')">Home</Link>
    <div>Hello World!</div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Head from "../Shared/Meta/Head"

export default {
    components: {Link, Head},
}
</script>
