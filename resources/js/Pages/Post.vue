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

        <Info v-if="preview" class="my-12" :href="`/wink/posts/${post.id}`">
            You are currently in preview.
            <InertiaLink v-if="post.is_published"
                         :href="route('posts.show', post.slug)"
                         class="font-medium text-blue-700 hover:text-blue-600">
                This post is published.
            </InertiaLink>
            <span v-else>
                You are viewing the post <span class="font-bold">as it will appear once published</span>.
            </span>
            <template #href>Edit Post</template>
        </Info>

        <div v-if="post.featured_image" class="relative">
            <div class="shadow-lg absolute rounded-md w-full h-full inset-0 bg-pest-pink transform -rotate-2"></div>
            <div class="shadow-lg absolute rounded-md w-full h-full inset-0 bg-pest-green transform rotate-2"></div>
            <img :src="post.featured_image"
                 :alt="post.featured_image_caption"
                 class="shadow-lg relative mt-8 rounded-md"
            >
        </div>

        <div class="mt-12 prose" v-html="post.content"></div>
    </Container>

    <Container wide class="mt-16">
        <RelatedPosts v-if="related_posts.length > 0"
                      :posts="related_posts"
                      class="mt-6"
        >
            <div>
                <h2 class="mt-12 text-3xl font-extrabold tracking-tight text-white">
                    Need even more Pest?
                </h2>
                <p class="mt-4 max-w-3xl text-lg text-pest-pink-100">
                    Subscribe to our free newsletter to get regular updates when we release new features,
                    tutorials, articles and more. Delivered weekly, no spam.
                </p>
                <SimpleSubscribeForm color="text-pest-pink-50" class="mt-4 sm:w-full sm:max-w-lg lg:flex-1"/>
            </div>
        </RelatedPosts>
    </Container>
</template>

<script>
import Head from "../Shared/Meta/Head"
import Container from "../Shared/Layout/Container";
import Heading from "../Shared/Layout/Heading";
import AuthorCentered from "../Shared/Author/Centered";
import Info from "../Shared/Layout/Alert/Info";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import RelatedPosts from "../Shared/Post/RelatedPosts";
import SimpleSubscribeForm from "../Shared/MailingList/SimpleSubscribeForm";

export default {
    name: "Post",
    components: {SimpleSubscribeForm, RelatedPosts, Info, AuthorCentered, Heading, Container, Head, InertiaLink},
    props: {
        post: {
            type: Object,
            required: true,
        },
        related_posts: {
            type: Array,
            required: true,
        },
        preview: {
            type: Boolean,
            default: false,
        }
    },
}
</script>
