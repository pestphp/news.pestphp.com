<template>
    <Head :title="article.title"></Head>
    <Container class="mt-8">
        <AuthorCentered :author="article.author"/>

        <Heading class="mt-6">{{ article.title }}</Heading>
        <div class="mt-1 flex space-x-1 text-sm text-gray-500">
            <time :datetime="article.publish_date.iso">
                {{ article.publish_date.diff }}
            </time>
            <span aria-hidden="true">&middot;</span>
            <span>
                {{ Math.ceil(article.read_time) }} minute read
            </span>
        </div>

        <div v-if="article.featured_image" class="relative">
            <div class="shadow-lg absolute rounded-md w-full h-full inset-0 bg-pink-400 transform -rotate-2"></div>
            <div class="shadow-lg absolute rounded-md w-full h-full inset-0 bg-teal-400 transform rotate-2"></div>
            <img :src="article.featured_image"
                 :alt="article.featured_image_caption"
                 class="shadow-lg relative mt-8 rounded-md"
            >
        </div>

        <div class="mt-12 prose" v-html="article.content"></div>
    </Container>
</template>

<script>
import Head from "../Shared/Meta/Head"
import Container from "../Shared/Layout/Container";
import Heading from "../Shared/Layout/Heading";
import AuthorCentered from "../Shared/Author/Centered";

export default {
    name: "Article",
    components: {AuthorCentered, Heading, Container, Head},
    props: {
        article: {
            type: Object,
        }
    },
}
</script>
