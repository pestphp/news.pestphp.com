<template>
    <header class="bg-white py-4 px-6 flex justify-between items-center shadow">
        <Logo/>
        <Nav/>
    </header>
</template>

<script>

import Logo from "./Logo";
import Nav from "./Nav";
export default {
    name: "Header",
    components: {Nav, Logo}
}
</script>
