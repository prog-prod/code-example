<template>
    <div class="product product-wide mb-4">
        <div class="row align-items-center">
            <div class="col-sm-4">
                <div class="product-thumb position-relative text-center">
                    <div class="overflow-hidden position-relative">
                        <Link :href="route('products.show', product.id)">
                            <template v-for="(image, key) in product.images" :key="key">
                                <img
                                    class="img-fluid w-100 mb-3"
                                    :class="key === 0 ? 'img-first' : 'img-second'"
                                    :src="assetStorage(image.filename)"
                                    alt="product-img"
                                />
                            </template>
                            <template v-if="product.images.length === 0">
                                <img
                                    class="img-fluid w-100 mb-3"
                                    :class="key === 0 ? 'img-first' : 'img-first'"
                                    :src="asset(defaultProductImg)"
                                    alt="product-img"
                                />
                            </template>
                        </Link>
                    </div>
                    <div class="product-hover-overlay">
                        <WishlistButton v-bind="{ product }" class="product-icon favorite"/>
                        <ComparisonButton v-bind="{ product }" class="product-icon cart"/>

                        <a
                            href="#"
                            data-vbtype="inline"
                            class="product-icon view venobox vbox-item"
                            data-toggle="tooltip"
                            data-placement="left"
                            title=""
                            data-original-title="Quick View"
                            @click.prevent="showQuickView"
                        ><i class="ti-search"></i
                        ></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="product-info">
                    <h3 class="mb-md-2 mb-2">
                        <Link
                            class="text-color"
                            :href="route('products.show', product.id)"
                        >
                            {{ product.name }}
                        </Link>
                    </h3>
                    <p class="mb-md-2 mb-3" v-html="shortDescription"></p>
                    <ProductPrice
                        :price="product.price.amount"
                        :currency="product.price.symbol"
                        :price-with-discount="
                            product.price_with_discount?.amount
                        "
                    />
                    <ul class="list-inline mt-3">
                        <li class="list-inline-item">
                            <a
                                href="https://demo.themefisher.com/elite-shop/shop-list.html#"
                                class="btn btn-dark btn-sm"
                                @click.prevent="addToWishlist"
                            >{{ __('main.add_to_wishlist') }}</a
                            >
                        </li>
                        <li class="list-inline-item">
                            <Link
                                :href="route('products.show',product.id)"
                                class="btn btn-primary btn-sm"
                            >{{ __('main.buy') }}
                            </Link
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- product label badge -->
        <ProductLabelBadge v-bind="{ product }"/>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';
import ProductLabelBadge from '@/Components/Shop/Products/Product/ProductLabelBadge.vue';
import ProductPrice from '@/Components/Shop/Products/Product/ProductPrice.vue';
import cart from '@/Mixins/cart.js';
import {mapActions} from 'vuex';
import product from '@/Mixins/product.js';
import WishlistButton from '@/Components/Shop/Product/WishlistButton.vue';
import ComparisonButton from '@/Components/Shop/Product/ComparisonButton.vue';

export default {
    name: 'ProductWide',
    components: {
        Link,
        ProductPrice,
        ProductLabelBadge,
        WishlistButton,
        ComparisonButton,
    },
    mixins: [cart, product],
    props: {
        product: Object,
    },
    computed: {
        shortDescription() {
            return this.product.description.length > 100 ? `${this.removeHtmlTags(this.product.description).substring(0, 100)}...` : this.product.description;
        },
    },
    methods: {
        ...mapActions({
            setQuickViewProduct: 'products/setQuickViewProduct',
            toggleQuickView: 'products/toggleQuickView',
        }),
        showQuickView() {
            this.setQuickViewProduct(this.product);
            this.toggleQuickView();
        },
    },
};
</script>

<style scoped></style>
