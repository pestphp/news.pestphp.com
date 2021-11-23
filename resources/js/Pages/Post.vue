<template>
    <Head :title="post.title"></Head>
    <Container class="mt-8">
        <AuthorCentered :author="post.author"/>

        <Heading class="mt-6">{{ post.title }}</Heading>
        <div class="mt-1 flex space-x-1 text-sm text-gray-500">
            <time :datetime="post.publish_date.iso">
                {{ post.publish_date.diff }}
            </time>
            <span aria-hidden="true">&middot;</span>
            <span>
                {{ Math.ceil(post.read_time) }} minute read
            </span>
        </div>

        <div v-if="post.featured_image" class="relative">
            <div class="shadow-lg absolute rounded-md w-full h-full inset-0 bg-pink-400 transform -rotate-2"></div>
            <div class="shadow-lg absolute rounded-md w-full h-full inset-0 bg-teal-400 transform rotate-2"></div>
            <img :src="post.featured_image"
                 :alt="post.featured_image_caption"
                 class="shadow-lg relative mt-8 rounded-md"
            >
        </div>

        <div class="mt-12 prose" v-html="post.content"></div>
    </Container>
</template>

<script>
import Head from "../Shared/Meta/Head"
import Container from "../Shared/Layout/Container";
import Heading from "../Shared/Layout/Heading";
import AuthorCentered from "../Shared/Author/Centered";

export default {
    name: "Post",
    components: {AuthorCentered, Heading, Container, Head},
    props: {
        post: {
            type: Object,
        }
    },
}
</script>
