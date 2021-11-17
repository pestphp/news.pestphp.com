<template>
    <ul class="flex space-x-6">
        <NavLink :href="route('home')" page="Home">Home</NavLink>
        <NavLink :href="route('blog')" page="Blog">Blog</NavLink>
        <NavLink href="https://pestphp.com/docs">Docs</NavLink>
    </ul>
</template>

<script>

import NavLink from "./NavLink";
export default {
    name: "Nav",
    components: {NavLink}
}
</script>
