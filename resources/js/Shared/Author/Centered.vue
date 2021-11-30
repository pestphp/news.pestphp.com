<template>
    <div class="mt-6 flex flex-col items-center text-center space-y-2">
        <a href="#" class="inline-block relative">
            <span class="sr-only">{{ author.name }}</span>
            <img class="h-14 w-14 rounded-md"
                 :src="author.avatar"
                 alt="Avatar">
        </a>
        <div>
            <p class="text-sm font-medium text-gray-900">
                <a href="#">
                    By {{ author.name }}
                </a>
            </p>
            <slot />
        </div>
    </div>
</template>

<script>

export default {
    name: "Centered",
    props: {
        author: {
            type: Object,
            required: true,
        },
    },
}
</script>
