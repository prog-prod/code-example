<template>
    <Head :title="__('reset-password.meta.title')"/>
    <section class="forget-password-page account">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="block text-center">
                        <Logo/>
                        <h2 class="text-center">
                            {{ __('reset-password.title') }}
                        </h2>
                        <form class="text-left clearfix" @submit.prevent="submit">
                            <div class="form-group">
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    :placeholder="__('reset-password.form.placeholders.email')"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.email"/>
                            </div>
                            <div class="form-group">
                                <TextInput
                                    id="email"
                                    v-model="form.password"
                                    type="password"
                                    :placeholder="__('reset-password.form.placeholders.password')"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.password"/>
                            </div>
                            <div class="form-group">
                                <TextInput
                                    id="email"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    :placeholder="__('reset-password.form.placeholders.password_confirmation')"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                            </div>
                            <div class="text-center">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    {{ __('reset-password.form.submit-btn') }}
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
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm, Head} from '@inertiajs/vue3';
import Logo from '@/Components/layouts/Logo.vue';

export default {
    components: {
        Logo,
        Head,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
    },
    props: {
        email: String,
        token: String,
    },
    data() {
        return {
            form: useForm({
                token: this.token,
                email: this.email,
                password: '',
                password_confirmation: '',
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route('password.store'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        },
    },
};
</script>
