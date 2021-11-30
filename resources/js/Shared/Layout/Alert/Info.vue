<template>
    <div class="rounded-md bg-blue-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <InformationCircleIcon class="h-5 w-5 text-blue-400" aria-hidden="true"/>
            </div>
            <div class="ml-3 flex-1 md:flex md:justify-between">
                <p class="text-sm text-blue-700">
                    <slot />
                </p>
                <p v-if="href" class="mt-3 text-sm md:mt-0 md:ml-6">
                    <a :href="href" class="whitespace-nowrap font-medium text-blue-700 hover:text-blue-600">
                        <slot name="href">More</slot>
                        <span aria-hidden="true" class="ml-1">&rarr;</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import {InformationCircleIcon} from '@heroicons/vue/solid'

export default {
    components: {
        InformationCircleIcon,
    },
    props: {
        href: {
            type: String,
            default: null,
        }
    },
}
</script>
