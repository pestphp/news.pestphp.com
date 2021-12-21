<template>
    <footer class="bg-white mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
            <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer">
                <div class="px-5 py-2">
                    <InertiaLink :href="route('home')" class="text-base text-gray-500 hover:text-gray-900">
                        Home
                    </InertiaLink>
                </div>

                <div class="px-5 py-2">
                    <InertiaLink :href="route('blog')" class="text-base text-gray-500 hover:text-gray-900">
                        Blog
                    </InertiaLink>
                </div>

                <div class="px-5 py-2">
                    <a href="https://pestphp.com/docs" class="text-base text-gray-500 hover:text-gray-900">
                        Docs
                    </a>
                </div>
            </nav>
            <p class="mt-8 text-center text-base text-gray-400">
                &copy; 2021 Pest | Code highlighting provided by <a href="https://torchlight.dev" class="text-pest-green-500 hover:text-pest-green-700">Torchlight</a>
            </p>
        </div>
    </footer>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: "Footer",
    components: {InertiaLink},
}
</script>
