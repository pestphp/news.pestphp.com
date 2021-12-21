<template>
    <Head></Head>
    <Container wide class="mt-12">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                Latest posts
            </h2>
            <ul ref="latestPosts" class="snap-x flex overflow-x-auto space-x-4 pt-4 pb-6">
                <li v-for="post in posts.data"
                    class="snap-start flex-shrink-0 flex flex-col rounded-lg bg-white shadow-sm overflow-hidden w-4/5 md:w-[580px]"
                    :key="post.id"
                >
                    <InertiaLink :href="route('posts.show', post.slug)" class="block">
                        <component
                            :is="post.featured_image ? 'img' : 'div'"
                            :src="post.featured_image"
                            :alt="post.featured_image_caption"
                            class="aspect-video w-full h-full object-cover"
                            :class="{ 'image-fallback': post.featured_image === null }"
                        />
                    </InertiaLink>
                    <InertiaLink :href="route('posts.show', post.slug)" class="flex-1 flex flex-col py-4 px-6">
                        <h3 class="flex-1 text-xl font-bold tracking-tight text-gray-800 line-clamp-1">
                            {{ post.title }}
                        </h3>
                        <p class="mt-2 text-gray-600 line-clamp-2">{{ post.excerpt }}</p>
                        <AuthorLeftAligned :author="post.author">
                            <div class="mt-1 flex space-x-1 text-sm text-gray-500">
                                <time :datetime="post.publish_date.iso">
                                    {{ post.publish_date.diff }}
                                </time>
                                <span aria-hidden="true">&middot;</span>
                                <span>
                                    {{ Math.ceil(post.read_time) }} minute read
                                </span>
                            </div>
                        </AuthorLeftAligned>
                    </InertiaLink>
                </li>
            </ul>
        </div>
        <HomePageMailingListSignup/>
    </Container>
</template>

<script>
import {InertiaLink, Link} from '@inertiajs/inertia-vue3'
import Head from "../Shared/Meta/Head"
import HomePageMailingListSignup from "../Shared/MailingList/HomePageMailingListSignup";
import Container from "../Shared/Layout/Container";
import AuthorLeftAligned from "../Shared/Author/LeftAligned";

export default {
    components: {Container, HomePageMailingListSignup, Link, Head, InertiaLink, AuthorLeftAligned},
    props: {
        posts: {
            type: Object,
            required: true,
        }
    },
}
</script>
