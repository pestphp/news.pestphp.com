<template>
    <Link :href="route('home')">Home</Link>
    <div>Hello World!</div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link,
    },
}
</script>
