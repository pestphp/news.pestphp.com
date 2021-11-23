<template>
  <InertiaLink :href="route('home')">
    <img src="/assets/small-logo.png" alt="Pest PHP">
    <span class="sr-only">Pest PHP</span>
  </InertiaLink>
</template>

<script>
import {InertiaLink} from '@inertiajs/inertia-vue3'

export default {
  name: "Logo",
  components: {InertiaLink},
}
</script>
