<template>
    <div class="checkout-product">
        <Link
            target="_blank" class="checkout-product__title js-product-title"
            :href="productService.getProductLink()">
            <figure class="checkout-product__figure"><span
                class="checkout-product__picture"><img
                loading="lazy"
                :src="productService.getProductImagePath()"
                alt="Ігрова приставка PS5 PlayStation 5" class="ng-star-inserted"></span>
                <figcaption>
                    <div class="checkout-product__title-product">{{ product.name }}</div>
                </figcaption>
            </figure>
        </Link>
        <dl class="checkout-product__options">
            <div class="checkout-product__option js-product-price">
                <dt class="checkout-product__label">Ціна</dt>
                <dd class="checkout-product__digit">
                    <span
                        class="checkout-product__price"
                        :class="{'checkout-product__price_color_red': product.price_with_discount }">
                    {{ product.price_with_discount?.amount || product.price.amount }}
                    <span class="currency">{{ product.price.symbol }}</span></span>
                    <span
                        v-if="product.price_with_discount"
                        class="checkout-product__price_type_old ng-star-inserted">{{ product.price.amount }}<span
                        class=" currency">{{ product.price.symbol }}</span></span></dd>
            </div>
            <div
                class="checkout-product__option checkout-product__option--quantity js-product-quantity ng-star-inserted">
                <dt class="checkout-product__label">Кількість</dt>
                <dd class="checkout-product__digit">{{ quantity }}</dd>
            </div>
            <div class="checkout-product__option js-product-amount">
                <dt class="checkout-product__label">Сума</dt>
                <dd class="checkout-product__digit">
                    <template v-if="product.price_with_discount">
                        {{ cartService.calcSubTotalDiscount(cartItem) }}
                    </template>
                    <template v-else>
                        {{ cartService.calcSubTotalForItem(cartItem) }}
                    </template>
                    <span class=" currency">{{ product.price.symbol }}</span></dd>
            </div>
        </dl>
    </div>
</template>
<script>
import {Link} from '@inertiajs/vue3';
import {ProductService} from '@/Services/ProductService.ts';
import ProductPrice from '@/Components/Shop/Products/Product/ProductPrice.vue';
import {CartService} from '@/Services/CartService.ts';

export default {
    name: 'CheckoutProduct',
    components: {
        ProductPrice,
        Link,
    },
    props: {
        product: {
            type: Object,
            require: true,
        },
        quantity: {
            type: Number,
            require: true,
        },
    },
    computed: {
        cartItem() {
            return {product: this.product, quantity: this.quantity};
        },
        productService() {
            return new ProductService(this.product);
        },
        cartService() {
            return new CartService(this.product);
        },
    },
};
</script>

<style lang="scss" scoped>
@import "@/../sass/_variables.scss";

.checkout-product {
    flex-direction: column;
    align-items: center;
    display: flex;
    padding-bottom: 16px;

    @media (min-width: $min_width_md) {
        flex-direction: row;
        align-items: flex-start;

        .checkout-product__title {
            width: 40%;
            margin-bottom: 0;
        }
    }

    &__title {
        width: 100%;
        margin-bottom: 16px;
        font-size: 12px;
        line-height: 17px;
    }

    &__figure {
        display: flex;
        flex-direction: row;
        align-items: center;

        figcaption {
            display: block;
        }
    }

    &__picture {
        display: flex;
        flex-direction: row;
        align-items: center;

        justify-content: center;
        flex-shrink: 0;
        width: 56px;
        height: 56px;
        margin-right: 16px;

        img {
            width: auto;
            max-width: 100%;
            height: auto;
            max-height: 100%;
        }
    }

    &__options {
        display: flex;
        flex-direction: row;
        width: 100%;
        @media (min-width: $min_width_md) {
            width: 60%;
        }
    }

    &__option {
        flex-grow: 1;
        text-align: center;
        width: 33.33333%;
    }

    &__option--quantity {
        flex-grow: 0;
        padding-left: 8px;
        padding-right: 8px;
    }

    &__label {
        display: block;
        margin-bottom: 4px;
        color: #797878;
        font-size: 10px;
        font-weight: 400;
        line-height: 14px;
    }

    &__digit {
        font-size: 14px;
        line-height: 20px;
    }

    &__price_color_red {
        color: #f84147;
    }

    &__price_type_old {
        display: block;
        margin-top: 2px;
        font-size: 10px;
        color: #797878;
        line-height: 14px;
        text-decoration: line-through;
    }

    .currency {
        margin-left: 4px;
    }
}
</style>
