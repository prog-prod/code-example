<template>
    <h5 class="mb-md-5 mb-4 border-bottom pb-2">
        <span>1.</span> {{ __('checkout.contact_information') }}
    </h5>
    <form action="#" class="row" @submit.prevent>
        <div class="col-sm-6">
            <TextInput
                v-model="form.firstName"
                class="form-control"
                :error="form.errors.firstName"
                :label="`${__('checkout.form.labels.first_name')}*`"
                :placeholder="__('checkout.form.placeholders.last_name')"
                required
                @keyup="validate('firstName')"/>
        </div>
        <div class="col-sm-6">
            <TextInput
                v-model="form.lastName"
                class="form-control"
                :error="form.errors.lastName"
                :label="`${__('checkout.form.labels.last_name')}*`"
                :placeholder="__('checkout.form.placeholders.first_name')"
                required
                @keyup="validate('lastName')"/>
        </div>
        <div class="col-sm-6">
            <TextInput
                v-model="form.phone"
                :type="CustomInputTypes.Phone"
                class="form-control"
                :error="form.errors.phone"
                :confirm-code-error="form.errors.confirm_phone_code"
                :show-confirm-phone-value="showConfirmPhone"
                :root-class="showConfirmPhone ? 'mb-1': ''"
                :class="{'mb-1': showConfirmPhone}"
                confirmation
                :confirm-code-value="form.confirm_phone_code"
                :label="`${__('checkout.form.labels.phone')}*`"
                :placeholder="__('checkout.form.placeholders.phone')"
                :confirmed="isVerifiedPhone"
                required
                @on-key-up-confirm-code="validate('confirm_phone_code')"
                @update:confirm-code-value="updateConfirmCode"
                @update:show-confirm-phone-value="updateShowConfirmPhone"
                @keyup="validate('phone');onTypingPhone()"/>
        </div>
        <div class="col-sm-6">
            <TextInput
                v-model="form.email"
                type="email"
                class="form-control"
                :label="`${__('checkout.form.labels.email')}*`"
                :placeholder="__('checkout.form.placeholders.email')"
                :error="form.errors.email"
                required
                @keyup="validate('email')"/>

        </div>
        <div class="col-12">
            <h5 class="border-bottom pb-2">
                <span>2.</span>
                {{ __('checkout.order') }}
            </h5>
        </div>
        <div class="col-sm-12 mb-4">
            <h5 class="d-flex justify-content-between mb-5 pb-2">
                <span>{{ __('checkout.products_in_order') }}:</span><span>{{ __('checkout.for_the_sum') }}: {{
                    total
                }} {{ currency }}</span></h5>
            <template v-for="(item, key) in cart.items" :key="key">
                <CheckoutProduct :product="item.product" :quantity="item.quantity"/>
            </template>
        </div>
        <!-- select shipping method -->
        <div class="col-12">
            <h5 class="mb-5 border-bottom pb-2">
                <span>3.</span>
                {{ __('checkout.shipping_method') }}
            </h5>
        </div>
        <template v-for="(method,key) in deliveryMethods" :key="key">
            <div class="col-12 mb-4">
                <RadioButton
                    v-model="form.deliveryMethod"
                    :value="method.key"
                    :error="form.errors.deliveryMethod"
                    :label="method.name"
                    :description="deliveryService.getShippingToDayString(method)"
                    @change="validate('deliveryMethod')"/>
                <DeliveryForm v-if="method.key === form.deliveryMethod" :method="method"/>
            </div>
        </template>
        <div class="col-12">
            <h5 class="mb-5 border-bottom pb-2">
                <span>4.</span>
                {{ __('checkout.payment_method') }}
            </h5>
        </div>
        <template v-for="(method,key) in paymentsMethods" :key="key">
            <template v-if="method.active">
                <div class="col-12 mb-4">
                    <RadioButton
                        v-model="form.paymentMethod"
                        :value="method.key"
                        :error="form.errors.paymentMethod"
                        :label="method.name"
                        @change="validate('paymentMethod')"
                    />
                </div>
            </template>
        </template>
        <div class="col-12 mb-5 mt-4">
            <CheckboxComponent
                v-model="form.call_me_back">{{ __('checkout.form.labels.call_me_back') }}
            </CheckboxComponent>
        </div>
        <!-- /select shipping method -->
    </form>
</template>

<script>
import TextInput from '@/Components/TextInput.vue';
import checkout from '@/Mixins/checkout.js';
import {vMaska} from 'maska';
import {mapActions, mapGetters} from 'vuex';
import CheckoutProduct from '@/Components/Payment/Checkout/CheckoutProduct.vue';
import {CartService} from '@/Services/CartService.ts';
import RadioButton from '@/Components/UI/RadioButton.vue';
import DeliveryForm from '@/Components/Payment/Checkout/DeliveryForm.vue';
import {DeliveryService} from '@/Services/DeliveryService.ts';
import {CustomInputTypes} from '@/Services/Enumns/CustomInputTypes.ts';
import FormService from '@/Services/FormService.ts';
import {DeliveryMethods} from '@/Services/Enumns/DeliveryMethods.ts';
import CheckboxComponent from '@/Components/UI/CheckboxComponent.vue';

export default {
    name: 'ShippingForm',
    components: {
        CheckboxComponent,
        RadioButton,
        CheckoutProduct,
        TextInput,
        DeliveryForm,
    },
    directives: {maska: vMaska},
    mixins: [checkout],
    props: {
        deliveryMethods: {
            type: Array,
            required: true,
        },
        paymentsMethods: {
            type: Array,
            required: true,
        },
        showConfirmPhoneBlock: {
            type: Boolean,
            default: false,
        },
        isVerifiedPhone: {
            type: Boolean,
        },
        cachedPhones: {
            type: Array,
            default: null,
        },
    },
    emits: ['onConfirmPhoneBtnClick', 'onConfirmPhone', 'onTypingPhone', 'update:isVerifiedPhone'],
    data: () => {
        return {
            CustomInputTypes,
            countryOptions: [],
            cityOptions: [],
            streetOptions: [],
            verifiedPhones: [],
            showConfirmPhone: false,
        };
    },
    computed: {
        isVerifiedPhoneLocal: {
            get() {
                return this.isVerifiedPhone;
            },
            set(value) {
                return this.$emit('update:isVerifiedPhone', value);
            },
        },
        currency() {
            return this.cartService.currency();
        },
        total() {
            return this.cartService.calcTotal();
        },
        countItems() {
            return this.cartService.countItems();
        },
        cart() {
            return this.$page.props.cart;
        },
        cartService() {
            return new CartService(this.cart);
        },
        deliveryService() {
            return new DeliveryService(this);
        },
        ...mapGetters({
            form: 'checkout/form',
            formRules: 'checkout/formRules',
        }),
    },
    watch: {
        isVerifiedPhone(val) {
            if (val) {
                const phone = FormService.clearPhone(this.form.phone);
                if (!this.verifiedPhones.includes(phone)) {
                    this.verifiedPhones.push(phone);
                }
            }
        },
        'form.deliveryMethod'(val) {
            if (val === DeliveryMethods.NOVAPOSHTA_COURIER) {
                this.removeFormRules({
                    rule: 'required',
                    fields: [
                        'deliveryDepartmentCity',
                        'deliveryDepartment',
                    ],
                });
                this.pushFormRules({
                    rule: 'required',
                    fields: [
                        'city',
                        'street',
                        'house',
                    ],
                });
            } else if (val === DeliveryMethods.NOVAPOSHTA_DEPARTMENT) {
                this.pushFormRules({
                    rule: 'required',
                    fields: [
                        'deliveryDepartmentCity',
                        'deliveryDepartment',
                    ],
                });
                this.removeFormRules({
                    rule: 'required',
                    fields: [
                        'city',
                        'street',
                        'house',
                    ],
                });
            }
        },
    },
    mounted() {
        this.initForm();
    },
    methods: {
        onTypingPhone() {
            const phone = FormService.clearPhone(this.form.phone);
            this.isVerifiedPhoneLocal = this.verifiedPhones.includes(phone);
        },
        updateShowConfirmPhone(value) {
            this.showConfirmPhone = value;
        },
        updateConfirmCode(value) {
            this.form.confirm_phone_code = value;
        },
        ...mapActions({
            updateFormElements: 'checkout/updateFormElements',
            removeFormRules: 'checkout/removeFormRules',
            pushFormRules: 'checkout/pushFormRules',
        }),
        validate(field) {
            FormService.validateShippingFormField(this.form, this.formRules, field);
        },
        initForm() {
            let phone = this.form.phone;
            if (this.user) {
                if (this.userService.isPhoneVerified()) {
                    this.verifiedPhones = [...this.verifiedPhones, FormService.clearPhone(this.user.phone)];
                }

                if (this.cachedPhones && this.cachedPhones.length > 0) {
                    phone = this.cachedPhones[this.cachedPhones.length - 1];
                } else {
                    phone = this.user.phone;
                }

                this.updateFormElements({
                    firstName: this.user.first_name,
                    lastName: this.user.last_name,
                    phone,
                    email: this.user.email,
                });
            }
            if (this.cachedPhones && this.cachedPhones.length > 0) {
                this.verifiedPhones = [...this.verifiedPhones, ...this.cachedPhones];
                phone = this.cachedPhones[this.cachedPhones.length - 1];
                this.updateFormElements({
                    phone,
                });
                this.isVerifiedPhoneLocal = this.cachedPhones[this.cachedPhones.length - 1] === phone || this.isVerifiedPhone;
            } else {
                this.isVerifiedPhoneLocal = this.userService.isPhoneVerified() || this.isVerifiedPhone;
            }
        },
        fetchCities(search, loading) {
            this.formService.debouncedFetchCities(search, loading).then(data => this.cityOptions = data);
        },
    },
};
</script>

<style lang="scss" scoped>
.confirm-phone-block {
    margin-bottom: 20px;

    small {
        margin-top: 10px;
        margin-bottom: 10px;
        display: inline-block;
        line-height: 16px;
    }
}
</style>
