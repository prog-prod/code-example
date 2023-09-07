<template>
    <div class="row">
        <ul class="products-grid">
            <template v-for="(product,key) in products" :key="key">
                <li class="products-grid__cell ng-star-inserted">
                    <ComparisonProduct :product="product"/>
                </li>
            </template>
        </ul>

        <ProductCharacteristics v-bind="{ products }"/>

        <div v-if="products.length === 0" class="result-not-found">
            <img :src="asset('images/no-result-found.png')" alt="">
            <div class="px-3">
                <h4>{{ __('products.result_not_found') }}</h4>
                <h5 class="text-muted">{{ __('products.result_not_found.text') }} 😔</h5>
            </div>
        </div>
        <!-- product -->

        <!-- //end of product -->
        <div ref="productList" class="col-12 mt-5">
            <BootstrapPagination v-bind="{ meta }"/>
        </div>
    </div>
</template>

<script>
import BootstrapPagination from '@/Components/Shop/Products/BootstrapPagination.vue';
import ComparisonProduct from '@/Components/Comparisons/ComparisonProduct.vue';
import ProductCharacteristics from '@/Components/Comparisons/ProductCharacteristics.vue';

export default {
    name: 'ComparisonsList',
    components: {
        BootstrapPagination,
        ComparisonProduct,
        ProductCharacteristics,
    },
    props: {
        products: Array,
        meta: Object,
        links: Array,
    },
};
</script>

<style lang="scss" scoped>
.products-grid {
    display: grid;
    width: 100%;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    margin-bottom: 16px;
}

.products-grid__cell {
    padding: 16px;
    border-bottom: 1px solid #e9e9e9;
    border-right: 1px solid #e9e9e9;
}
</style>
