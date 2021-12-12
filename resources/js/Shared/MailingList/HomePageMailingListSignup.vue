<template>

    <div class="py-10 px-6 bg-pest-green rounded-3xl sm:py-16 sm:px-12 lg:p-20 lg:flex lg:items-center">
        <div class="lg:w-0 lg:flex-1">
            <h2 class="text-3xl font-extrabold tracking-tight text-white">
                Keep up to date on all things Pest
            </h2>
            <p class="mt-4 max-w-3xl text-lg text-pest-green-100">
                Subscribe to our free newsletter to get regular updates when we release new features,
                tutorials, articles and more. Delivered weekly, no spam.
            </p>
        </div>
        <SimpleSubscribeForm color="text-pest-green-100" class="mt-12 sm:w-full sm:max-w-md lg:mt-0 lg:ml-8 lg:flex-1" />
    </div>
</template>

<script>
import SubscribeWrapper from "./SubscribeWrapper";
import Input from "../Form/Input";
import Button from "../Form/Button";
import SimpleSubscribeForm from "./SimpleSubscribeForm";

export default {
    name: "HomePageMailingListSignup",
    components: {SimpleSubscribeForm, Button, Input, SubscribeWrapper}
}
</script>
