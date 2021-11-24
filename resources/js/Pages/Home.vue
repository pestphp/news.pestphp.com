<template>
    <Head></Head>
    <div class="max-w-7xl mx-auto mt-12">
        <HomePageMailingListSignup/>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
import Head from "../Shared/Meta/Head"
import HomePageMailingListSignup from "../Shared/MailingList/HomePageMailingListSignup";

export default {
    components: {HomePageMailingListSignup, Link, Head},
}
</script>
