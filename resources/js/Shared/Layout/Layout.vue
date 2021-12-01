<template>
    <div class="flex flex-col min-h-screen">
        <Header/>
        <div class="flex-grow">
            <Banner :content="$page.props.flash.message"/>
            <slot/>
        </div>
        <Footer/>
    </div>
</template>

<script>
import Footer from "./Footer";
import Header from "./Header";
import Banner from "./Banner";

export default {
    name: "Layout",
    components: {Banner, Header, Footer}
}
</script>
