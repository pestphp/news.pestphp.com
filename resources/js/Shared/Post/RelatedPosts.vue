<template>
    <div class="py-10 px-6 sm:py-16 sm:px-12 lg:p-20 bg-pest-pink rounded-3xl">
        <div>
            <h2 class="text-3xl tracking-tight font-extrabold text-white sm:text-4xl">
                Related Posts
            </h2>
            <p class="mt-3 text-xl text-pest-pink-50 sm:mt-4">
                Keep on reading for more Pest goodness.
            </p>
        </div>
        <div class="mt-4 grid gap-8 lg:grid-cols-3 lg:gap-x-5 lg:gap-y-12">
            <div v-for="post in posts" :key="post.slug">
                <InertiaLink :href="route('posts.show', post.slug)" class="block mt-4">
                    <p class="text-xl font-semibold text-white line-clamp-1">
                        {{ post.title }}
                    </p>
                    <p class="mt-3 text-base text-pest-pink-50 line-clamp-3 max-w-prose">
                        {{ post.excerpt }}
                    </p>
                </InertiaLink>
                <AuthorLeftAligned :author="post.author" color="text-pest-pink-50"/>
            </div>
        </div>
        <slot />
    </div>
</template>

<script>
import AuthorLeftAligned from "../Author/LeftAligned";
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    components: {AuthorLeftAligned, InertiaLink},
    props: {
        posts: {
            type: Array,
            required: true,
        },
    },
}
</script>
