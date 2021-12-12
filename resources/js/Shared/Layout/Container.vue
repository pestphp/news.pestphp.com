<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div v-if="!wide" class="max-w-3xl mx-auto">
            <slot />
        </div>
        <slot v-if="wide"/>
    </div>
</template>

<script>

export default {
    name: "Container",
    props: {
        wide: {
            type: Boolean,
            default: false,
        }
    },
}
</script>
