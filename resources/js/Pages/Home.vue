<template>
    <Head></Head>
    <Container wide class="mt-12">
        <HomePageMailingListSignup/>
    </Container>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
import Head from "../Shared/Meta/Head"
import HomePageMailingListSignup from "../Shared/MailingList/HomePageMailingListSignup";
import Container from "../Shared/Layout/Container";

export default {
    components: {Container, HomePageMailingListSignup, Link, Head},
}
</script>
