<template>
    <div>
        <Head :title="__('login.meta.title')"/>
        <section class="signin-page account">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="block text-center">
                            <Logo/>
                            <h2 class="text-center">{{ __('login.title') }}</h2>
                            <form class="text-left clearfix" @submit.prevent="submit">
                                <div class="form-group">
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        :placeholder="__('login.form.email')"
                                        class="form-control"
                                        required
                                        autofocus
                                    />
                                    <InputError class="text-danger mt-2" :message="form.errors.email"/>

                                </div>
                                <div class="form-group">
                                    <TextInput
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        :placeholder="__('login.form.password')"
                                        class="form-control"
                                        required
                                    />
                                    <InputError class="mt-2" :message="form.errors.password"/>

                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label class="flex items-center">
                                        <Checkbox v-model:checked="form.remember" name="remember"/>
                                        <span
                                            class="ml-2 text-sm text-gray-600">{{
                                                __('login.remember-checkbox')
                                            }}</span>
                                    </label>
                                    <Link
                                        v-if="canResetPassword"
                                        :href="route('password.request')"
                                    >
                                        {{ __('login.forgot-password-btn') }}
                                    </Link>
                                </div>
                                <div class="text-center">
                                    <PrimaryButton
                                        :class="[{ 'opacity-25': form.processing }, '']"
                                        :disabled="form.processing">
                                        {{ __('login.submit-btn') }}
                                    </PrimaryButton>
                                </div>
                            </form>
                            <p class="mt-3">
                                <Link :href="route('register')">{{ __('login.register-btn') }}</Link>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Logo from '@/Components/layouts/Logo.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';

export default {
    components: {
        Checkbox,
        InputError,
        PrimaryButton,
        TextInput,
        Logo,
        Link,
        Head,
    },
    layout: [AuthLayout],
    props: {
        canResetPassword: {
            type: Boolean,
            default: false,
        },
        status: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            form: useForm({
                email: '',
                password: '',
                remember: false,
                from: this.route().params.from || null,
            }),
        };
    },
    methods: {
        submit() {
            try {
                this.form.post(route('login'), {
                    onFinish: () => this.form.reset('password'),
                });
            } catch (e) {
                console.log(e);
            }
        },
    },
};
</script>


