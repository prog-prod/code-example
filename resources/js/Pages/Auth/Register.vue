<template>
    <div>
        <Head :title="__('registration.meta.title')"/>
        <section class="signin-page account">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="block text-center">
                            <Logo/>
                            <h2 class="text-center">{{ __('registration.title') }}</h2>
                            <form
                                class="text-left clearfix"
                                @submit.prevent="submit">
                                <div class="form-group">
                                    <TextInput
                                        id="fname"
                                        v-model="form.firstName"
                                        type="text"
                                        class="form-control"
                                        :placeholder="__('registration.form.placeholder.first-name')"
                                        :error="form.errors.firstName"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />
                                </div>
                                <div class="form-group">
                                    <TextInput
                                        id="lname"
                                        v-model="form.lastName"
                                        type="text"
                                        class="form-control"
                                        :placeholder="__('registration.form.placeholder.last-name')"
                                        :error="form.errors.lastName"
                                        required
                                        autofocus
                                    />
                                </div>
                                <div class="form-group">
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        :placeholder="__('registration.form.placeholder.email')"
                                        class="form-control"
                                        :error="form.errors.email"
                                        required
                                    />
                                </div>
                                <div class="form-group">
                                    <TextInput
                                        id="phone"
                                        v-model="form.phone"
                                        :type="CustomInputTypes.Phone"
                                        :placeholder="__('registration.form.placeholder.phone')"
                                        class="form-control"
                                        :error="form.errors.phone"
                                        :confirm-code-error="form.errors.confirm_phone_code"
                                        :show-confirm-phone-value="showConfirmPhone"
                                        confirmation
                                        required
                                        :confirmed="isVerifiedPhone"
                                        :confirm-code-value="form.confirm_phone_code"
                                        @on-key-up-confirm-code="validate('confirm_phone_code')"
                                        @update:confirm-code-value="updateConfirmCode"
                                        @update:show-confirm-phone-value="updateShowConfirmPhone"
                                    />
                                </div>
                                <div class="form-group">
                                    <TextInput
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        :placeholder="__('registration.form.placeholder.password')"
                                        class="form-control"
                                        :error="form.errors.password"
                                        required
                                    />
                                </div>
                                <div class="form-group">
                                    <TextInput
                                        id="password_confirmation"
                                        v-model="form.password_confirmation"
                                        type="password"
                                        :placeholder="__('registration.form.placeholder.password-repeat')"
                                        class="form-control"
                                        :error="form.errors.password_confirmation"
                                        required
                                        autocomplete="new-password"
                                    />
                                </div>
                                <div class="text-center">
                                    <PrimaryButton
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        {{ __('registration.form.submit-btn') }}
                                    </PrimaryButton>
                                </div>
                            </form>
                            <p class="mt-3">
                                <Link
                                    :href="route('login')"
                                    class=""
                                >
                                    {{ __('registration.already_registered') }}
                                </Link>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Logo from '@/Components/layouts/Logo.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import FormService from '@/Services/FormService.ts';
import {CustomInputTypes} from '@/Services/Enumns/CustomInputTypes.ts';

export default {
    components: {
        PrimaryButton,
        TextInput,
        Link,
        Head,
        Logo,
    },
    layout: [AuthLayout],
    props: {
        isVerifiedPhone: {
            type: Boolean,
        },
    },
    data: () => ({
        showConfirmPhone: false,
        form: useForm({
            firstName: '',
            lastName: '',
            email: '',
            phone: '+38 (',
            password: '',
            password_confirmation: '',
            confirm_phone_code: '',
            terms: false,
        }),
        formRules: {
            required: [
                'firstName',
                'lastName',
                'phone',
                'email',
            ],
            email: ['email'],
            phone: ['phone'],
            confirm_phone_code: ['confirm_phone_code'],
        },
    }),
    computed: {
        CustomInputTypes() {
            return CustomInputTypes;
        },
    },
    methods: {
        validate(field) {
            FormService.validateShippingFormField(this.form, this.formRules, field);
        },
        updateShowConfirmPhone(value) {
            this.showConfirmPhone = value;
        },
        updateConfirmCode(value) {
            this.form.confirm_phone_code = value;
        },
        submit() {
            this.form.transform((data) => ({
                ...data,
                phone: FormService.clearPhone(data.phone),
                confirm_phone_code: FormService.clearPhone(data.confirm_phone_code),
            })).post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        },
    },
};
</script>
