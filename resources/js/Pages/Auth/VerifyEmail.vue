<template>
    <Head :title="__('verify-email.meta.title')"/>

    <section class="forget-password-page account">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="block text-center">
                        <Logo/>
                        <h2 class="text-center">
                            {{ __('verify-email.title') }}
                        </h2>
                        <form class="text-left clearfix" @submit.prevent="submit">
                            <p>
                                {{ __('verify-email.success-text') }}
                            </p>
                            <p v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">
                                {{ __('verify-email.verification-link-sent') }}
                            </p>
                            <div class="text-center">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    {{ __('verify-email.resent-verification-btn') }}
                                </PrimaryButton>
                            </div>
                        </form>
                        <p class="mt-3">
                            <Link :href="route('products.index')">
                                {{ __('verify-email.shop-link-text') }}
                            </Link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Logo from '@/Components/layouts/Logo.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';

export default {
    components: {
        PrimaryButton,
        Head,
        Link,
        Logo,
    },
    layout: [AuthLayout],
    props: {
        status: String,
    },
    data() {
        return {
            form: useForm({}),
        };
    },
    computed: {
        verificationLinkSent() {
            return this.status === 'verification-link-sent';
        },
    },
    methods: {
        submit() {
            this.form.post(route('verification.send'));
        },
    },
};
</script>
