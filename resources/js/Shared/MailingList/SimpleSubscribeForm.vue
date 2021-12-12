<template>
    <div>
        <SubscribeWrapper v-slot="{form, subscribe, on, bind}">
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
                <Button :disabled="form.processing"
                        class="self-end w-full mt-3 sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">Notify me
                </Button>
            </form>
            <p :class="[textColor, 'mt-3 text-sm']">
                We care about the protection of your data. Read our
                <a href="#" class="text-white font-medium underline">
                    Privacy Policy.
                </a>
            </p>
        </SubscribeWrapper>
    </div>
</template>

<script>

import SubscribeWrapper from "./SubscribeWrapper";
import Input from "../Form/Input";
import Button from "../Form/Button";

export default {
    name: "SimpleSubscribeForm",
    components: {Button, Input, SubscribeWrapper},
    props: {
        theme: {
            type: String,
            default: "gray",
            options: ["gray", "green", "pink"],
        }
    },
    computed: {
        textColor() {
            return {
                'gray': 'text-gray-900',
                'green': 'text-pest-green-100',
                'pink': 'text-pest-pink-100',
            }[this.theme]
        }
    }
}
</script>
