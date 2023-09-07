<template>
    <Head :title="__('cart.head')"/>
    <div class="section">
        <div class="cart shopping">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="block">
                            <div class="product-list">
                                <div class="table-responsive">
                                    <table class="table cart-table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th class="product-name-col">{{ __('cart.table.product.name') }}</th>
                                            <th class="text-center">{{ __('cart.table.product.price') }}</th>
                                            <th>{{ __('cart.table.product.quantity') }}</th>
                                            <th>{{ __('cart.table.product.sub_total') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(item,key) in cart.items" :key="key">
                                            <td>
                                                <a
                                                    class="product-remove" href="#"
                                                    @click.prevent="removeItem(item)">×</a>
                                            </td>
                                            <td>
                                                <div class="product-info d-flex">
                                                    <div>
                                                        <img
                                                            class="product-img img-fluid"
                                                            :src="productImage(item.product)"
                                                            alt="product-img">
                                                    </div>
                                                    <div class="d-inline-block text-left">
                                                        <Link
                                                            class="d-block ml-2"
                                                            :href="route('products.show',item.product.id)">
                                                            {{ item.product.name }}
                                                        </Link>
                                                        <h6 v-if="item.size" class="text-muted mb-1 ml-2">
                                                            {{ __('cart.table.product.size') }}: {{ item.size.name }}
                                                        </h6>
                                                        <h6 v-if="item.color" class="text-muted mb-0 ml-2">
                                                            {{ __('cart.table.product.color') }}: {{ item.color.name }}
                                                        </h6>
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                <ProductPrice
                                                    class="d-flex align-items-center"
                                                    :price="item.product.price.amount"
                                                    :currency="item.product.price.symbol"
                                                    :price-with-discount="item.product.price_with_discount?.amount"/>
                                            </td>
                                            <td>
                                                <QuantityInput
                                                    v-model="item.quantity"
                                                    :max="item.product.stock_quantity"/>
                                            </td>
                                            <td>
                                                <ProductPrice
                                                    class="d-flex align-items-center"
                                                    :price="cartService.calcSubTotalForItem(item)"
                                                    :currency="item.product.price.symbol"
                                                    :price-with-discount="cartService.calcSubTotalDiscount(item)"/>
                                            </td>
                                        </tr>
                                        <tr v-if="cart.items.length === 0">
                                            <td class="text-center" colspan="5">{{
                                                    __('cart.table.cart_is_empty')
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <template v-if="cart.items.length > 0">
                                    <hr>
                                    <div class="d-flex flex-column flex-md-row align-items-center">
                                        <input
                                            id="coupon"
                                            type="text"
                                            class="form-control text-md-left text-center mb-3 mb-md-0" name="coupon"
                                            :placeholder="__('cart.coupon_field_placeholder')">
                                        <button class="btn btn-outline-primary ml-md-3 w-100 mb-3 mb-md-0">
                                            {{ __('cart.apply_coupon') }}
                                        </button>
                                        <Link
                                            :href="route('products.index')"
                                            class="btn ml-md-4 btn-dark w-100">{{ __('cart.update_cart') }}
                                        </Link>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="list-unstyled text-right">
                                                <li>{{ __('cart.table.product.sub_total') }} <span
                                                    class="d-inline-block w-100px">{{
                                                        subTotal
                                                    }} {{ currency }}</span>
                                                </li>

                                                <template v-for="(tax, key) in taxes" :key="key">
                                                    <li>{{ __('cart.taxes') }} <span class="d-inline-block w-100px">{{
                                                            tax.amount
                                                        }} {{ tax.symbol }}</span></li>
                                                </template>
                                                <template v-if="taxes.length === 0">
                                                    <li>
                                                        {{ __('cart.taxes') }} <span class="d-inline-block w-100px">0 {{
                                                            currency
                                                        }}</span>
                                                    </li>
                                                </template>
                                                <li>{{ __('cart.grand_total') }} <span
                                                    class="d-inline-block w-100px">{{ total }}  {{
                                                        currency
                                                    }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <Link
                                        :href="route('checkout.index')"
                                        class="btn btn-primary float-right">{{ __('cart.checkout') }}
                                    </Link>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import ProductPrice from '@/Components/Shop/Products/Product/ProductPrice.vue';
import QuantityInput from '@/Components/Cart/QuantityInput.vue';
import {Head, Link} from '@inertiajs/vue3';
import {CartService} from '@/Services/CartService';
import product from '@/Mixins/product.js';

export default {
    name: 'Cart',
    components: {
        ProductPrice,
        QuantityInput,
        Link,
        Head,
    },
    mixins: [product],
    layout: [BaseLayout],
    props: {
        cart: Array,
    },
    computed: {
        subTotal() {
            return this.cartService.calcSubTotal();
        },
        currency() {
            return this.cartService.currency();
        },
        total() {
            return this.cartService.calcTotal();
        },
        taxes() {
            return this.cart.taxes;
        },
        cartService() {
            return new CartService(this.cart);
        },
    },
    mounted() {
        console.log(this.cart);
    },
    methods: {
        productImage(product) {
            return product.main_image ? this.assetStorage(product.main_image.filename) : this.assetStorage(this.defaultProductImg);
        },
        calcSubTotal(item) {
            return item.product.price.amount * item.quantity;
        },
        removeItem(item) {
            this.$request.send('post', route('cart.delete', {
                product: item.product.id,
                color: item.color?.id,
                size: item.size?.id,
            }));
        },
    },
};
</script>
<style lang="scss">
.cart {
    .input-group-append .btn, .input-group-prepend .btn {
        z-index: unset !important;
    }
}
</style>
<style scoped>
.product-name-col {
    width: 320px;
    max-width: 320px;
}

.product-img {
    width: 9rem;
}
</style>
