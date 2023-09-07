<template>
    <div>
        <div class="product-grid">
            <template v-for="(product,key) in products" :key="key">
                <Product v-if="isGrid" v-bind="{product, key}"></Product>
                <template v-else>
                    <ProductWide v-bind="{product, key}"></ProductWide>
                </template>
            </template>
            <div v-if="products.length === 0" class="result-not-found">
                <img :src="asset('images/no-result-found.png')" alt="">
                <div class="px-3">
                    <h4>{{ __('products.result_not_found') }}</h4>
                    <h5 class="text-muted">{{ __('products.result_not_found.text') }} 😔</h5>
                </div>
            </div>
        </div>

        <!-- product -->
        <div class="row">
            <div ref="productList" class="col-12 mt-3 text-center">
                <LoadMoreButton v-bind="{ meta }"></LoadMoreButton>
            </div>
        </div>
        <div class="row">
            <!-- //end of product -->
            <div ref="productList" class="col-12 mt-5 text-center">
                <BootstrapPagination v-bind="{ meta }"/>
            </div>
        </div>
    </div>
</template>

<script>

import Product from '@/Components/Shop/Products/Product.vue';
import {usePage} from '@inertiajs/vue3';
import BootstrapPagination from '@/Components/Shop/Products/BootstrapPagination.vue';
import {mapActions, mapGetters} from 'vuex';
import ProductWide from '@/Components/Shop/Products/ProductWide.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import LoadMoreButton from '@/Components/Shop/Products/LoadMoreButton.vue';

export default {
    name: 'ProductList',
    components: {
        PrimaryButton,
        ProductWide,
        Product,
        BootstrapPagination,
        LoadMoreButton,
    },
    props: {
        products: Array,
        meta: Object,
        links: Array,
    },
    data: () => {
        const {$inertia} = usePage();
        return {
            inertia: $inertia,
        };
    },
    computed: {
        ...mapGetters({
            isGrid: 'layout/isGridLayout',
        }),
    },
    methods: {
        ...mapActions({
            setLayout: 'layout/setLayout',
        }),
        toggleLayout() {
            this.setLayout(this.isGrid ? 'list' : 'grid');
        },
    },
};
</script>

<style lang="scss" scoped>
.product-grid {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    padding-top: 5px;
    padding-bottom: 80px;

    .product:not(.product-wide) {
        width: 20%;
        box-shadow: inset 0 0 0 2px #fcfcfc;
        outline: 1px solid #f4f4f4;
        padding: 16px;
        @media (max-width: 1800px) {
            width: 25%;
        }
        @media (max-width: 1440px) {
            width: 33%;
        }
        @media (max-width: 1180px) {
            width: 50%;
        }
    }

}

.result-not-found {
    padding: 20px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;

    > img {
        width: 22%;
    }
}
</style>
