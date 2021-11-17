<template>
    <div class="flex flex-col min-h-screen">
        <Header/>
        <div class="flex-grow">
            <slot/>
        </div>
        <Footer/>
    </div>
</template>

<script>
import Footer from "./Footer";
import Header from "./Header";

export default {
    name: "Layout",
    components: {Header, Footer}
}
</script>
