<template>
    <div class="product ng-star-inserted">
        <div class="product__picture">
            <ProductImage :product="product" only-main/>
        </div>
        <div class="product__body">
            <div class="product__heading">
                <Link
                    class="product__heading"
                    :href="route('products.show', product.id)">
                    {{ product.name }}
                </Link>
            </div>
            <div class="product__footer">
                <div class="product__prices">
                    <ProductPriceComponent v-bind="{ product, quantity }" no-economy-text/>
                    <Link
                        :href="route('products.show', product.id)"
                        class="btn btn-buy btn-primary btn-sm"
                    >
                        {{ __('main.buy') }}
                    </Link>
                </div>
                <ProductStatus v-bind="{ product }"/>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';
import ProductStatus from '@/Components/Shop/Product/ProductStatus.vue';
import ProductImage from '@/Components/Shop/Products/ProductImage.vue';
import ProductPriceComponent from '@/Components/Shop/Product/ProductPriceComponent.vue';

export default {
    name: 'ComparisonProduct',
    components: {
        Link,
        ProductStatus,
        ProductImage,
        ProductPriceComponent,
    },
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    data: () => ({
        quantity: 1,
    }),
};
</script>

<style lang="scss" scoped>

.product, .product__picture {
    display: flex;
    flex-direction: row;
}

.product {
    width: 100%;
    height: 100%;

    .product__picture {
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        width: 72px;
        height: 72px;
    }

    .product__body {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        justify-content: space-between;
        height: 100%;
        padding-left: 8px;

        .product__footer {
            .product__availability {
                margin-bottom: 4px;
                font-size: 12px;
                line-height: normal;
            }

            :deep(.product__prices) {
                display: flex;
                flex-direction: row;
                align-items: flex-end;
                justify-content: space-between;
                margin-bottom: 4px;

                h4 {
                    font-size: 20px !important;
                }
            }
        }

        .product__heading {
            display: flex;
            flex-direction: row;
            width: 100%;
            margin-bottom: 16px;
            font-size: 14px;
            color: #333;
            word-break: break-word;
        }
    }
}
</style>
