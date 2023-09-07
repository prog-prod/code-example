<template>
    <div v-if="cart" class="header-actions">
        <button class="header-actions__btn" @click.prevent="toggle">
            <i v-if="cart.items.length > 0" class="ti-shopping-cart-full"></i>
            <i v-else class="ti-shopping-cart"></i>
            <span
                v-if="cart.items.length > 0"
                class="header-actions__btn__badge">{{ $page.props.settings.countItemsInCart || '' }}</span>

        </button>
        <div class="cart-wrapper" :class="{ open: isOpenedCart }">
            <i
                class="ti-close cart-close"
                @click.prevent="toggleCart(null)"
            ></i>
            <h4 class="mb-4">{{ __('header.cart.title') }}</h4>
            <ul ref="cart-list" class="cart-list pl-0 mb-3">
                <template v-for="(item, key) in cart.items" :key="key">
                    <li class="d-flex border-bottom">
                        <div>
                            <img
                                class="product-img img-fluid"
                                :src="productImage(item.product)"
                                alt="product-img"
                            />
                        </div>
                        <div class="mx-3">
                            <h6>
                                <Link :href="productService.getProductLink(item.product)">
                                    {{ item.product.name }}
                                </link>
                            </h6>
                            <div class="d-flex">
                                <span class="text-24 mr-3"
                                >{{ item.quantity }} X</span
                                >
                                <ProductPrice
                                    class="d-flex align-items-center gap-1 flex-row-reverse"
                                    :currency="currency"
                                    :price="
                                        cartService.calcSubTotalForItem(item)
                                    "
                                    :price-with-discount="
                                        cartService.calcSubTotalDiscount(item)
                                    "
                                />
                            </div>
                        </div>
                        <a
                            class="product-remove"
                            href="#"
                            @click.prevent="removeItem($event,item)"
                        ><i class="ti-close"></i
                        ></a>
                    </li>
                </template>
                <template v-if="cart.items.length === 0">
                    <li class="d-flex border-bottom">
                        {{ __('header.cart.cart_is_empty') }}
                    </li>
                </template>
            </ul>
            <div class="cart-total-container mb-3">
                <span>{{ __('header.cart.total') }}:</span>
                <span class="float-right">{{ total }} {{ currency }}</span>
            </div>
            <div class="text-center d-flex">
                <Link
                    :href="route('cart')"
                    class="btn btn-dark btn-mobile mr-2 rounded-0"
                    @click="closeCartModal"
                    v-html="__('cart.view_cart')"
                />
                <Link
                    :href="route('checkout.index')"
                    class="btn btn-dark btn-mobile rounded-0"
                    @click="closeCartModal"
                    v-html="__('cart.check_out')"/>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';
import {CartService} from '@/Services/CartService.ts';
import ProductPrice from '@/Components/Shop/Products/Product/ProductPrice.vue';
import {mapGetters} from 'vuex';
import cart from '@/Mixins/cart.js';
import product from '@/Mixins/product.js';

export default {
    name: 'NavigationCart',
    components: {
        Link,
        ProductPrice,
    },
    mixins: [cart, product],
    data: () => ({
        navbarCollapse: null,
    }),
    computed: {
        ...mapGetters({
            isOpenedCart: 'layout/isOpenedCart',
        }),
        cart() {
            return this.$page.props.cart;
        },
        total() {
            return this.cartService.calcTotal();
        },
        taxes() {
            return this.cart.taxes;
        },
        currency() {
            return this.cartService.currency();
        },
        cartService() {
            return new CartService(this.cart);
        },
    },
    created() {
        console.log('cart', this.cart);
    },
    updated() {
        this.scrollToBottom();
    },
    mounted() {
        this.scrollToBottom();
        this.navbarCollapse = $('.navbar-collapse');
    },

    methods: {
        closeCartModal() {
            this.toggleCart(false);
        },
        scrollToBottom() {
            this.$refs['cart-list'].scrollTop =
                this.$refs['cart-list'].scrollHeight;
        },
        productImage(product) {
            return product.main_image ? this.assetStorage(product.main_image.filename) : this.assetStorage(this.defaultProductImg);
        },
        toggle() {
            this.toggleCart();
            if (this.navbarCollapse.hasClass('show')) {
                this.navbarCollapse.collapse('hide');
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@import "@/../sass/_variables.scss";

.cart-total-container {
    font-size: 16px;
}

.cart-wrapper {
    min-width: 320px;

    .btn {
        font-size: 13px;
        text-transform: uppercase;
        padding: 7.5px;
        width: 100%;
        font-weight: 400;
        border: 0;
        border-radius: 40px;
        position: relative;
        transition: 0.2s ease;
    }
}

.header-actions__btn__badge {
    background-color: #ff4135;
}

.product-img {
    width: 50px;

    @media (max-width: $max_width_cxs) {
        width: 70px;
    }
}

.cart-list {
    max-height: 300px;
    max-width: 400px;
    overflow-y: auto;
    scroll-behavior: smooth;
    scroll-margin-bottom: 10px;
}

.text-24 {
    font-size: 16px;
}

.gap-1 {
    gap: 10px;
}

.old-price {
    position: relative;
    display: inline-block;
    font-size: 14px;
    line-height: 1;
    text-decoration: line-through;
    color: #a6a5a5;
}
</style>
