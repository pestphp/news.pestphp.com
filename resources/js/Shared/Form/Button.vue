<template>
    <button type="submit"
            class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-pest-green-500 hover:bg-pest-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-pest-green-700 focus:ring-white disabled:bg-gray-300 transition">
        <slot>Submit</slot>
    </button>
</template>

<script>
export default {
    name: "Button"
}
</script>
