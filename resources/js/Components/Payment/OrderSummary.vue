<template>
    <div v-sticky="{ top: '70px', container: '.sticky-container' }" class="border-box p-4">
        <h4>{{ __('checkout.order_summary') }}</h4>
        <p>{{ __('checkout.i_have') }} <a href="#" @click.prevent>{{ __('checkout.promocode') }}</a></p>
        <p></p>
        <ul class="list-unstyled list-order-summary">
            <li class="justify-content-between">
                <span>{{ countItems }} {{ productsText }} {{ __('checkout.for_the_sum') }}</span>
                <span>{{ subTotal }} {{ currency }}</span>
            </li>
            <li class="justify-content-between">
                <span>{{ __('checkout.shipping_cost') }}</span>
                <span>
                    <Spinner v-show="showSpinner" width="25"/>
                    <template v-if="!showSpinner">{{ delivery }}</template>
                </span>
            </li>
            <li class="justify-content-between" :class="{'d-none': !showDeliveryBlock}">
                <span>{{ __('checkout.shipping_date') }}</span>
                <span>
                    <Spinner v-show="showSpinner" width="25"/>
                    <template v-if="!showSpinner">{{ deliveryDate }}</template>
                </span>
            </li>
        </ul>
        <hr>
        <div class="border-box__total-container d-flex justify-content-between">
            <span>{{ __('checkout.to_be_paid') }}</span>
            <strong>{{ total }} {{ currency }}</strong>
        </div>
        <hr>
        <div class="border-box__info-text">
            <p>
                {{ __('checkout.order_summary.info_text.conditions') }}
            </p>
            <ul>
                <li>{{ __('checkout.order_summary.info_text.conditions.1') }} <a href="" @click.prevent><i
                    class="ti-info-alt"></i></a></li>
                <li>{{ __('checkout.order_summary.info_text.conditions.2') }} <a href="" @click.prevent><i
                    class="ti-info-alt"></i></a></li>
            </ul>
        </div>
    </div>
</template>

<script>
import cart from '@/Mixins/cart.js';
import StickyDirective from '@/directives/StickyDirective.ts';
import {mapGetters} from 'vuex';
import {PaymentMethodsEnum} from '@/enums/PaymentMethodsEnum.js';
import DatetimeService from '@/Services/DatetimeService.ts';
import Spinner from '@/Components/UI/Spinner.vue';
import {DeliveryMethods} from '@/Services/Enumns/DeliveryMethods.ts';

export default {
    name: 'OrderSummary',
    components: {Spinner},
    directives: {sticky: StickyDirective},
    mixins: [cart],
    data: () => ({
        showSpinner: false,
    }),
    computed: {
        showDeliveryBlock() {
            return !!this.cart.delivery;
        },
        subTotal() {
            return this.cartService.calcSubTotal();
        },
        currency() {
            return this.cartService.currency();
        },
        taxes() {
            return this.cart.taxes.reduce((accumulator, item) => {
                const count = item || 0;
                return accumulator + count;
            }, 0);
        },
        delivery() {
            return this.cartService.getDeliveryCost();
        },
        deliveryDate() {
            return this.cartService.getDeliveryDate();
        },
        total() {
            return this.cartService.calcTotal();
        },
        productsText() {
            if (this.countItems === 1) {
                return this.__('checkout.product_1');
            } else if ([2, 3, 4].includes(this.countItems)) {
                return this.__('checkout.product_2');
            }
            return this.__('checkout.product_3');
        },
        ...mapGetters({
            form: 'checkout/form',
        }),
    },
    watch: {
        'form.paymentMethod'(val) {
            this.cart.deliveryTaxes = val === PaymentMethodsEnum.CASH;
        },
        'form.deliveryMethod'(val) {
            if (val === DeliveryMethods.NOVAPOSHTA_COURIER) {
                this.resetDeliveryDetails();
            } else if (this.form.deliveryDepartmentCity) {
                this.fetchDeliveryDetails(this.form.deliveryDepartmentCity);
            }
        },
        'form.deliveryDepartmentCity'(val) {
            if (val) {
                this.fetchDeliveryDetails(val);
            } else {
                this.resetDeliveryDetails();
            }
        },
    },
    methods: {
        resetDeliveryDetails() {
            this.cart.delivery = null;
            this.cart.deliveryDate = null;
        },
        fetchDeliveryDetails(cityRecipient) {
            this.showSpinner = true;
            const cartItems = this.cartService.getCartItems();
            Promise.all([
                this.$request.axios.get(this.route('api.calc-delivery-cost'), {
                    params: {
                        cityRecipient: cityRecipient.ref,
                        cartItems: cartItems,
                    },
                }).then(({data}) => {
                    if (data.length > 0) {
                        this.cart.delivery = data[0].cost;
                    }
                }),
                this.$request.axios.get(this.route('api.get-delivery-date'), {
                    params: {
                        cityRecipient: cityRecipient.ref,
                    },
                }).then(({data}) => {
                    this.cart.deliveryDate = DatetimeService.formatDateTime(data.date, 'dd.mm.yyyy HH:MM');
                    console.log(this.cart.deliveryDate);
                }),
            ]).then(() => {
                this.showSpinner = false;
            });
        },
    },
};
</script>

<style lang="scss" scoped>
.border-box {
    padding: 16px;
    background-color: #f5f5f5;
    border-radius: 4px;
    border: 1px solid #e9e9e9;

    &__info-text {
        p {
            margin-top: 16px;
            font-size: 12px;
            color: #797878;
        }

        ul {
            li {
                font-size: 12px;
                color: #797878;
                list-style-type: disc;
            }
        }
    }

    &__total-container {
        span {
            margin-right: 15px;
            font-size: 14px;
            color: #797878;
        }

        strong {
            font-size: 24px;
            font-weight: 500;
        }
    }

    ul.list-order-summary {
        li {
            display: flex;
            margin-top: 15px;

            span {

                &:first-child {
                    margin-right: 15px;
                    font-size: 13px;
                    color: #797878;
                    line-height: 16px;
                }

                &:last-child {
                    text-align: right;
                    line-height: 16px;
                    font-size: 14px;
                }
            }
        }
    }

    h4 {
        font-size: 28px;
        font-weight: 500;
        margin-bottom: 16px;
    }
}
</style>
