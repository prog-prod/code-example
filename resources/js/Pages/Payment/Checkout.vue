<template>
    <Head :title="__('checkout.title')"/>
    <!-- shipping method -->
    <section class="section">
        <div class="container sticky-container">
            <div class="row">
                <div class="col-md-8">
                    <div class="inner-wrapper border-box">
                        <h1 class="checkout-heading ng-star-inserted">{{ __('checkout.title') }}</h1>
                        <!-- shipping-address -->
                        <CheckoutForm
                            :is-verified-phone="isVerifiedPhoneLocal"
                            :delivery-methods="deliveryMethods"
                            :payments-methods="paymentMethods"
                            :cached-phones="cachedPhones"
                            @update:is-verified-phone="updateIsVerifiedPhoneLocal"
                        />
                        <!-- /shipping-address -->
                        <div class="p-4 bg-gray text-right">
                            <PrimaryButton
                                :href="route('checkout.payment.index')"
                                class="text-wrap"
                                @click.prevent="confirmOrder">{{ __('checkout.confirm_order_btn') }}
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <OrderSummary/>
                </div>
            </div>
        </div>
    </section>
    <!-- /shipping method -->
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import {Link, Head} from '@inertiajs/vue3';
import OrderSummary from '@/Components/Payment/OrderSummary.vue';
import CheckoutForm from '@/Components/Payment/Checkout/CheckoutForm.vue';
import {mapGetters} from 'vuex';
import FormService from '@/Services/FormService.ts';
import PrimaryButton from '@/Components/PrimaryButton.vue';

export default {
    name: 'Checkout',
    components: {
        PrimaryButton,
        OrderSummary,
        CheckoutForm,
        Link,
        Head,
    },
    layout: [BaseLayout],
    props: {
        deliveryMethods: Array,
        paymentMethods: Array,
        isVerifiedPhone: {
            type: Boolean,
        },
        cachedPhones: {
            type: Array,
        },
    },
    data: () => ({
        isVerifiedPhoneLocal: false,
    }),
    computed: {
        ...mapGetters({
            formData: 'checkout/form',
            formRules: 'checkout/formRules',
        }),
    },
    watch: {
        isVerifiedPhone(val) {
            this.isVerifiedPhoneLocal = val;
        },
    },
    mounted() {
        this.checkCartIsNotEmpty();
    },
    methods: {
        updateIsVerifiedPhoneLocal(val) {
            this.isVerifiedPhoneLocal = val;
        },
        checkCartIsNotEmpty() {
            if (this.$page.props.cart.items.length === 0) {
                this.notifyInfo(this.__('cart.table.cart_is_empty'));
                this.$request.send('get', this.route('products.index'));
            }
        },
        confirmOrder() {
            if (FormService.validateShippingForm(this.formData, this.formRules)) {
                this.notifyError(this.__('checkout.form.errors.have_errors'));
            } else if (!this.isVerifiedPhoneLocal) {
                this.notifyError(this.__('checkout.form.errors.confirm_phone_number'));
            }
            if (this.isVerifiedPhoneLocal && !this.formData.hasErrors) {
                this.formData.post(this.route('checkout.submit'));
            }
        },
    },
};
</script>

<style scoped>
.checkout-heading {
    margin-bottom: 16px;
    font-size: 24px;
    font-weight: 500;

}

@media (min-width: 1024px) {
    .checkout-heading {
        margin-bottom: 40px;
        font-size: 36px;
    }
}


</style>
