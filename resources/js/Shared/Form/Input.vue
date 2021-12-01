<template>
    <div>
        <input v-bind="$attrs"
               class="border-white px-5 py-3 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-pest-green-700 focus:ring-white rounded-md transition"
               :class="{'border-2 border-red-600': error}"
        />
        <span v-if="error" class="mt-2 text-sm text-red-600">{{ error }}</span>
    </div>
</template>

<script>

export default {
    name: "Input",
    inheritAttrs: false,
    props: {
        error: {
            type: String,
            default: null
        },
    },
}
</script>
