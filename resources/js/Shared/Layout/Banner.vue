<template>
    <transition enter-class="opacity-0"
                enter-to-class="opacity-1"
                leave-from-class="opacity-1"
                leave-to-class="opacity-0"
    >
        <div v-if="show" class="fixed inset-x-0 bg-pest-pink-600 transition transform shadow">
            <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <p class="font-medium text-white truncate">
                            {{ content }}
                        </p>
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                        <button @click="hideBanner()"
                                type="button"
                                class="-mr-1 flex p-2 rounded-md hover:bg-pest-pink-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                            <span class="sr-only">Dismiss</span>
                            <XIcon class="h-6 w-6 text-white" aria-hidden="true"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import {XIcon} from '@heroicons/vue/outline'
import {watch} from "vue";

export default {
    name: 'Banner',
    components: {
        XIcon,
    },
    props: {
        content: {
            type: String,
            default: null,
        },
    },
    data() {
        return {
            show: false,
            timeout: null,
        }
    },
    mounted() {
        this.showBanner()
    },
    watch: {
        content: {
            handler: function () {
                this.showBanner()
            },

        }
    },
    methods: {
        showBanner() {
            if (this.content === null) {
                return
            }

            this.show = true
            this.timeout = setTimeout(() => this.hideBanner(), 5000)
        },
        hideBanner() {
            if (this.timeout) {
                clearTimeout(this.timeout)
                this.timeout = null
            }

            this.show = false
        },
    },
}
</script>
