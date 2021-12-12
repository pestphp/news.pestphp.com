<template>
    <div :class="[color, 'mt-6 flex items-center']">
        <div class="flex-shrink-0">
            <span class="sr-only">{{ author.name }}</span>
            <img class="h-10 w-10 rounded-md" :src="author.avatar" alt="Avatar"/>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium">
                {{ author.name }}
            </p>
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    name: "LeftAligned",
    props: {
        author: {
            type: Object,
            required: true,
        },
        color: {
            type: String,
            default: 'text-gray-900',
        },
    },
}
</script>
