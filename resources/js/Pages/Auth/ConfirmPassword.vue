<template>
    <Head :title="__('confirm-password.meta.title')"/>
    <section class="forget-password-page account">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="block text-center">
                        <Logo/>
                        <p class="mt-3">
                            {{ __('confirm-password.hint') }}
                        </p>
                        <form class="text-left clearfix" @submit.prevent="submit">
                            <div class="form-group">
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    :placeholder="__('confirm-password.form.placeholders.password')"
                                    required
                                    autocomplete="current-password"
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.password"/>
                            </div>
                            <div class="text-center">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    {{ __('confirm-password.submit-btn') }}
                                </PrimaryButton>
                            </div>
                        </form>
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
    data() {
        return {
            form: useForm({
                password: '',
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route('password.confirm'), {
                onFinish: () => this.form.reset(),
            });
        },
    },
};
</script>
