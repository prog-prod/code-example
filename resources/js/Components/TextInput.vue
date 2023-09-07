<template>
    <div class="form-control-group" :class="rootClass">
        <label v-if="label" :for="inputId">{{ label }}</label>
        <template v-if="isPhoneType">
            <div class="position-relative">
                <input
                    :id="inputId"
                    ref="input"
                    v-maska
                    class="form-control"
                    :class="{'rounded-0': !rounded}"
                    :type="inputType"
                    v-bind="$attrs"
                    :placeholder="placeholder"
                    data-maska="+38 (###) ###-##-##"
                    :value="modelValue"
                    @keyup="typingPhoneNumber()"
                    @input="updateModelValue($event.target.value)"
                />
                <i v-if="confirmed" class="confirmed-icon ti ti-check text-success"></i>
            </div>
            <template v-if="showConfirmPhone && confirmation">
                <div v-if="confirmationCodeSent" ref="confirm-phone-block" class="confirm-phone-block">
                    <small>{{ __('checkout.send_sms_hint') }}</small>
                    <TextInput
                        ref="confirmation_code_input"
                        v-model="confirmCode"
                        :type="CustomInputTypes.ConfirmationCode"
                        class="form-control mb-2"
                        root-class="mb-1"
                        :error="confirmCodeError"
                        :placeholder="__('checkout.form.placeholders.phone_code_confirmation')"
                        required
                        @keyup="onKeyUpConfirmCode"/>
                    <div>
                        <PrimaryButton type="button" class="btn-sm" @click="confirmPhone">{{
                                __('checkout.btn.confirm_phone')
                            }}
                        </PrimaryButton>
                        <PrimaryButton
                            type="button"
                            class="btn-sm ml-2 my-3"
                            :disabled="smsTimerStarted"
                            @click="sendSMSCode">
                            <template v-if="smsTimerStarted">
                                <phone-send-sms-timer
                                    v-model="smsTimerStarted"
                                    :minutes-time="smsTimer.minutes"
                                    :seconds-time="smsTimer.seconds"/>
                            </template>
                            <template v-else>
                                {{ __('checkout.btn.send_code_btn') }}
                            </template>
                        </PrimaryButton>
                    </div>
                </div>
                <div v-else>
                    <small>{{ __('checkout.confirm_phone_hint') }}</small>
                    <PrimaryButton
                        type="button"
                        class="d-block btn-sm my-3"
                        :disabled="smsTimerStarted"
                        @click="sendSMSCode">
                        <template v-if="smsTimerStarted">
                            <phone-send-sms-timer
                                v-model="smsTimerStarted"
                                :minutes-time="smsTimer.minutes"
                                :seconds-time="smsTimer.seconds"/>
                        </template>
                        <template v-else>
                            {{
                                __('checkout.btn.send_code_btn')
                            }}
                        </template>
                    </PrimaryButton>
                </div>
            </template>
        </template>
        <template v-else-if="isConfirmationCodeType">
            <input
                :id="inputId"
                ref="input"
                v-maska
                class="form-control"
                :class="{'rounded-0': !rounded}"
                :type="inputType"
                v-bind="$attrs"
                :placeholder="placeholder"
                data-maska="##-##-##"
                :value="modelValue"
                @input="updateModelValue($event.target.value)"
            />
        </template>
        <template v-else>
            <input
                :id="inputId"
                ref="input"
                class="form-control"
                :class="{'rounded-0': !rounded}"
                v-bind="$attrs"
                :type="inputType"
                :placeholder="placeholder"
                :value="modelValue"
                @input="updateModelValue($event.target.value)"
            />
        </template>
        <InputError v-if="error" class="text-danger mt-2" :message="error"/>
    </div>
</template>

<script>
import FormService from '@/Services/FormService.ts';
import {InputType} from '@/Services/Enumns/InputTypes.ts';
import {CustomInputTypes} from '@/Services/Enumns/CustomInputTypes.ts';
import {vMaska} from 'maska';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PhoneSendSmsTimer from '@/Components/PhoneSendSmsTimer.vue';

export default {
    name: 'TextInput',
    components: {PhoneSendSmsTimer, PrimaryButton, InputError},
    directives: {maska: vMaska},
    inheritAttrs: false,
    props: {
        modelValue: {
            type: String,
            required: true,
        },
        confirmCodeValue: {
            type: String,
            required: false,
        },
        showConfirmPhoneValue: {
            type: Boolean,
            required: false,
        },
        placeholder: {
            type: String,
            required: true,
        },
        error: {
            type: String,
            default: '',
            required: false,
        },
        label: {
            type: String,
            default: null,
        },
        rootClass: {
            type: String,
            default: null,
        },
        type: {
            type: String,
            default: 'text',
        },
        confirmed: {
            type: Boolean,
            required: false,
            default: false,
        },
        rounded: {
            type: Boolean,
            default: true,
        },
        confirmation: {
            type: Boolean,
            default: true,
        },
        confirmCodeError: {
            type: String,
            default: '',
            required: false,
        },
    },
    emits: ['update:modelValue', 'onTypingPhone', 'onKeyUpConfirmCode', 'update:updateConfirmCodeValue', 'resetConfirmationForm', 'update:showConfirmPhoneValue', 'onConfirmPhone', 'update:confirmCodeValue', 'keyUp'],
    data() {
        return {
            inputId: `input-${Math.floor(Math.random() * 10000)}`,
            smsTimerStarted: false,
            confirmationCodeSent: false,
            smsTimer: {
                minutes: 1,
                seconds: 0,
            },
        };
    },
    computed: {
        model: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.updateModelValue(value);
            },
        },
        showConfirmPhone: {
            get() {
                return this.showConfirmPhoneValue;
            },
            set(value) {
                this.$emit('update:showConfirmPhoneValue', value);
            },
        },
        confirmCode: {
            get() {
                return this.confirmCodeValue;
            },
            set(value) {
                this.$emit('update:confirmCodeValue', value);
            },
        },
        CustomInputTypes() {
            return CustomInputTypes;
        },
        isPhoneType() {
            return this.type === CustomInputTypes.Phone;
        },
        isConfirmationCodeType() {
            return this.type === CustomInputTypes.ConfirmationCode;
        },
        inputType() {
            return FormService.isInputType(this.type) ? this.type : InputType.Text;
        },
    },
    watch: {
        confirmed(val) {
            if (val) {
                this.showConfirmPhone = false;
            }
        },
        model() {
            if (this.isPhoneType) {
                this.resetConfirmationForm();
            }
        },
    },
    mounted() {
        if (this.$refs.input.getAttribute('autofocus') !== null) {
            this.$refs.input.focus();
        }
    },
    methods: {
        sendSMSCode() {
            this.smsTimerStarted = true;
            this.confirmationCodeSent = true;

            this.$request.send('post', this.route('send-code'), {
                phone: FormService.clearPhone(this.modelValue),
            }, {
                preserveScroll: true,
                onSuccess: () => {
                    this.notifySuccess(this.__('checkout.form.messages.sms_sent'));
                },
            });
        },
        resetConfirmationForm() {
            this.$emit('resetConfirmationForm');
            this.confirmCode = null;
            this.confirmationCodeSent = false;
        },
        onKeyUpConfirmCode() {
            this.$emit('onKeyUpConfirmCode');
        },
        typingPhoneNumber() {
            this.$emit('keyUp', this.model);
            this.showConfirmPhone = FormService.isValidPhone(this.model) && !this.confirmed;
        },
        focus() {
            this.$refs.input.focus();
        },
        confirmPhone() {
            this.$emit('onConfirmPhone');
            this.$request.send('post', this.route('verify-phone'), {
                phone: FormService.clearPhone(this.model),
                code: FormService.clearPhoneCode(this.confirmCode),
            }, {
                preserveScroll: true,
                onSuccess: () => {
                    if (!this.confirmed) {
                        this.notifyError(this.__('checkout.wrong_confirmation_code'));
                    } else {
                        this.notifySuccess(this.__('checkout.phone_confirmed'));

                    }
                },
            });
        },
        updateModelValue(value) {
            this.$emit('update:modelValue', value);
        },
    },
};
</script>

<style lang="scss" scoped>
.confirmed-icon {
    position: absolute;
    top: 18px;
    right: 20px;
    font-size: 18px;
}

.inner-wrapper .form-control-group {
    margin-bottom: 30px;
}

.form-control {
    margin-bottom: 0;
}

input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
