<template>
    <Head></Head>
    <Container wide class="mt-12">
        <ul class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 place-items-stretch">
            <li v-for="post in posts.data" :key="post.id" class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                <InertiaLink :href="route('posts.show', post.slug)" class="flex-shrink-0">
                    <img class="aspect-video w-full h-full object-cover"
                         :src="post.featured_image"
                         :alt="post.featured_image_caption">
                </InertiaLink>
                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-pest-pink-600">
                            <a href="#" class="hover:underline">
                                Article
                            </a>
                        </p>
                        <InertiaLink :href="route('posts.show', post.slug)" class="block mt-2">
                            <p class="text-xl font-semibold text-gray-900">
                                {{ post.title }}
                            </p>
                            <p class="mt-3 text-base text-gray-500 line-clamp-5">
                                {{ post.excerpt }}
                            </p>
                        </InertiaLink>
                    </div>
                    <div class="mt-6 flex items-center">
                        <AuthorLeftAligned :author="post.author"/>
                    </div>
                </div>
            </li>
        </ul>
    </Container>
</template>

<script>
import Head from "../Shared/Meta/Head"
import Container from "../Shared/Layout/Container";
import AuthorLeftAligned from "../Shared/Author/LeftAligned";
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: "Blog",
    components: {AuthorLeftAligned, Container, Head, InertiaLink},
    props: {
        posts: {
            type: Object,
            required: true
        }
    },
}
</script>
