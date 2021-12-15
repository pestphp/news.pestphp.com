<template>
    <Head></Head>
    <Container wide class="mt-12">
        <ul class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 place-items-stretch">
            <li v-for="post in allPosts" :key="post.id" class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                <InertiaLink :href="route('posts.show', post.slug)" class="flex-shrink-0">
                    <component
                        :is="post.featured_image ? 'img' : 'div'"
                        :src="post.featured_image"
                        :alt="post.featured_image_caption"
                        class="aspect-video w-full h-full object-cover"
                        :class="{ 'image-fallback': post.featured_image === null }"
                    />
                </InertiaLink>
                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                    <div class="flex-1">
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
                    </div>
                </div>
            </li>
        </ul>
        <span ref="loadMoreIntersect"/>
        <Info v-if="posts.next_page_url === null" class="mt-12">
            You're all up to date! 🥳
        </Info>
    </Container>
</template>

<script>
import Head from "../../Shared/Meta/Head"
import Container from "../../Shared/Layout/Container";
import AuthorLeftAligned from "../../Shared/Author/LeftAligned";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import Button from "../../Shared/Form/Button";
import Info from "../../Shared/Layout/Alert/Info";

export default {
    name: "Blog",
    components: {Info, Button, AuthorLeftAligned, Container, Head, InertiaLink},
    mounted() {
        const observer = new IntersectionObserver(entries => entries.forEach(entry => entry.isIntersecting && this.loadMorePosts(), {
            rootMargin: "-150px 0px 0px 0px"
        }));

        observer.observe(this.$refs.loadMoreIntersect)
    },
    props: {
        posts: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            allPosts: this.posts.data,
            initialUrl: this.$page.url,
        }
    },
    methods: {
        loadMorePosts() {
            if (this.posts.next_page_url === null) {
                return
            }

            this.$inertia.get(this.posts.next_page_url, {}, {
                preserveState: true,
                preserveScroll: true,
                only: ['posts'],
                onSuccess: () => {
                    this.allPosts = [...this.allPosts, ...this.posts.data]
                    window.history.replaceState({}, this.$page.title, this.initialUrl)
                }
            })
        }
    }
}
</script>
