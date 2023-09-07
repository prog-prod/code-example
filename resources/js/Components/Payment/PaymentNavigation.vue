<template>
    <!-- navbar -->
    <div class="justify-content-between nav mb-5">
        <a
            class="text-center d-inline-block nav-item"
            :class="{'active': route().current() === 'checkout.index'}"
            @click.prevent>
            <i class="ti-truck d-block mb-2"></i>
            <span class="d-block h4">{{ __('checkout.shipping_method') }}</span>
        </a>
        <a
            class="text-center d-inline-block nav-item"
            :class="{'active': route().current() === 'checkout.payment.index'}"
            @click.prevent>
            <i class="ti-wallet d-block mb-2"></i>
            <span class="d-block h4">{{ __('checkout.payment_method') }}</span>
        </a>
        <a
            class="text-center d-inline-block nav-item"
            :class="{'active': route().current() === 'checkout.review.index'}"
            @click.prevent>
            <i class="ti-eye d-block mb-2"></i>
            <span class="d-block h4">{{ __('checkout.review') }}</span>
        </a>
    </div>
    <!-- /navbar -->
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'PaymentNavigation',
    components: {
        Link,
    },
    mounted() {
        this.checkCartIsNotEmpty();
    },
    methods: {
        checkCartIsNotEmpty() {
            if (this.$page.props.cart.items.length === 0) {
                this.notifyInfo(this.__('cart.table.cart_is_empty'));
                this.$request.send('get', this.route('products.index'));
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@import "@/../sass/_variables.scss";

.nav {
    flex-wrap: nowrap;

    a {
        span {
            @media (max-width: $max_width_xs) {
                font-size: 15px;
            }
            @media (max-width: $max_width_cxs) {
                font-size: 11px;
            }
        }
    }
}
</style>
