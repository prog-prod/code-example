<template>
    <div class="product text-center">
        <div class="product-thumb">
            <div class="overflow-hidden position-relative">
                <ProductImage :product="product" :is-large="isLargePreview"/>
                <div class="btn-cart">
                    <Link
                        :href="productLink"
                        class="btn btn-buy btn-primary btn-sm"
                    >{{ __('main.buy') }}
                    </Link>
                </div>
            </div>
            <div class="product-hover-overlay">
                <WishlistButton
                    v v-bind="{ product }" class="product-icon active favorite"/>
                <ComparisonButton
                    v-bind="{ product }" class="product-icon cart"
                    :class="{'active': product.added_in_comparisons }"/>
                <a
                    href="#"
                    data-vbtype="inline"
                    class="product-icon view venobox vbox-item"
                    data-toggle="tooltip"
                    data-placement="left"
                    :title="__('product.quick_view')"
                    data-original-title="Quick View"
                    @click.prevent="showQuickView"
                ><i class="ti-zoom-in"></i
                ></a>
            </div>
        </div>
        <div class="product-info">
            <h3 class="product__title">
                <Link class="text-color" :href="productLink"
                >{{ product.name }}
                </Link>
            </h3>
            <div v-if="withRating" class="goods-tile__stars ng-star-inserted">

                <Link :href="productLink" class="goods-tile__reviews-link">
                    <template v-if="rating">
                        <star-rating
                            v-model:rating="rating"
                            :read-only="true"
                            :increment="0.1"
                            :star-size="10"
                            :max-rating="5"
                            active-color="#ffba00"
                            :show-rating="false"
                        ></star-rating>
                        <span class="goods-tile__reviews-link ml-1">  {{
                                product.reviews.length
                            }} {{ __('product.details.rating.reviews') }}</span>
                    </template>
                    <template v-else>
                        <i class="ti ti-comment"></i> {{ __('product.leave_review') }}
                    </template>
                </Link>
            </div>
            <ProductStatus class="product_availability" v-bind="{ product }"/>
            <ProductPrice
                :price="product.price.amount"
                :currency="product.price.symbol"
                :price-with-discount="product.price_with_discount?.amount"
            />
        </div>
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
import StarRating from 'vue-star-rating';
import WishlistButton from '@/Components/Shop/Product/WishlistButton.vue';
import ComparisonButton from '@/Components/Shop/Product/ComparisonButton.vue';
import ProductImage from '@/Components/Shop/Products/ProductImage.vue';
import ProductStatus from '@/Components/Shop/Product/ProductStatus.vue';

export default {
    name: 'Product',
    components: {
        ProductStatus,
        Link,
        ProductPrice,
        ProductLabelBadge,
        StarRating,
        WishlistButton,
        ComparisonButton,
        ProductImage,
    },
    mixins: [cart, product],
    props: {
        isLargePreview: {
            default: false,
            type: Boolean,
        },
        product: {
            required: true,
            type: Object,
        },
        withRating: {
            type: Boolean,
            default: true,
        },
    },
    data: () => ({
        step: 1,
        size: null,
        color: null,
        rating: null,
    }),
    mounted() {
        this.rating = this.product.avg_rating;
    },
    methods: {
        ...mapActions({
            setQuickViewProduct: 'products/setQuickViewProduct',
            toggleQuickView: 'products/toggleQuickView',
        }),
        addToComparison() {
            this.$request.send('post', route('comparisons.add', ['product', this.product.id]), null, {
                onFinish: () => {
                    this.notifySuccess(this.__('messages.success'));
                },
            });
        },
        showQuickView() {
            this.setQuickViewProduct(this.product);
            this.toggleQuickView();
        },
    },

};
</script>

<style lang="scss">
.product_availability {
    margin-bottom: 4px;
    font-size: 12px;
    text-align: left;
}

.btn-buy {
    min-width: 120px;
}

.product {
    width: 100%;
}

.product-info {
    padding-top: 20px;
}

.goods-tile__rating, .goods-tile__stars {
    position: relative;
    display: flex;
    flex-direction: row;
    padding-left: 2px;
}

.product__title {
    display: block;
    height: 20px;
    margin-bottom: 0px;
    overflow: hidden;
    font-size: 16px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    color: #333;
    text-align: left;
}
</style>
