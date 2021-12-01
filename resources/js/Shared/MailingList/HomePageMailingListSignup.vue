<template>
    <SubscribeWrapper v-slot="{form, subscribe, on, bind}">
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
            <div class="mt-12 sm:w-full sm:max-w-md lg:mt-0 lg:ml-8 lg:flex-1">
                <form @submit.prevent="subscribe" class="sm:flex">
                    <div class="w-full space-y-2">
                        <label for="email-address" class="sr-only">Email address</label>
                        <Input v-on="on.email"
                               v-bind="bind.email"
                               :error="form.errors.email"
                               id="email-address"
                               type="email"
                               required=""
                               placeholder="Email address"
                               class="w-full"
                        />
                        <label for="first-name" class="sr-only">First name</label>
                        <Input v-on="on.firstName"
                               v-bind="bind.firstName"
                               :error="form.errors.firstName"
                               id="first-name"
                               type="text"
                               required=""
                               placeholder="First name"
                               autocomplete="given-name"
                               class="w-full"
                        />
                        <label for="last-name" class="sr-only">Last name</label>
                        <Input v-on="on.lastName"
                               v-bind="bind.lastName"
                               :error="form.errors.lastName"
                               id="last-name"
                               type="text"
                               required=""
                               placeholder="Last name"
                               autocomplete="family-name"
                               class="w-full"
                        />
                    </div>
                    <Button :disabled="form.processing" class="self-end w-full mt-3 sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">Notify me</Button>
                </form>
                <p class="mt-3 text-sm text-pest-green-100">
                    We care about the protection of your data. Read our
                    <a href="#" class="text-white font-medium underline">
                        Privacy Policy.
                    </a>
                </p>
            </div>
        </div>
    </SubscribeWrapper>
</template>

<script>
import SubscribeWrapper from "./SubscribeWrapper";
import Input from "../Form/Input";
import Button from "../Form/Button";

export default {
    name: "HomePageMailingListSignup",
    components: {Button, Input, SubscribeWrapper}
}
</script>
