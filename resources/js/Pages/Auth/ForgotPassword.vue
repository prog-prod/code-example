<template>
    <div>
        <Head :title="__('forgot-password.meta.title')"/>

        <section class="forget-password-page account">
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="block text-center">
                            <Logo/>
                            <h2 class="text-center">{{ __('forgot-password.title') }}</h2>
                            <form class="text-left clearfix" @submit.prevent="submit">
                                <p>{{ __('forgot-password.hint-text') }}</p>
                                <div class="form-group">
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        :placeholder="__('forgot-password.form.email-placeholder')"
                                        class="form-control"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />

                                    <InputError class="mt-2" :message="form.errors.email"/>
                                </div>
                                <div class="text-center">
                                    <PrimaryButton
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        {{ __('forgot-password.submit-btn') }}
                                    </PrimaryButton>
                                </div>
                            </form>
                            <p class="mt-3">
                                <Link :href="route('login')">{{ __('forgot-password.back-btn') }}</Link>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>
<script>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Logo from '@/Components/layouts/Logo.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';

export default {
    components: {
        InputLabel,
        InputError,
        PrimaryButton,
        TextInput,
        Head,
        Logo,
        Link,
    },
    layout: [AuthLayout],
    props: {
        status: String,
    },
    data: () => ({
        form: useForm({
            email: '',
        }),
    }),
    methods: {
        submit() {
            this.form.post(this.route('password.email'));
        },
    },
};
</script>


