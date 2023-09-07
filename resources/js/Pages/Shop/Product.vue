<template>
    <div>
        <Head :title="title"/>
        <Breadcrumbs v-bind="{ breadcrumbs }"/>
        <QuickView/>
        <!-- product-single -->
        <ProductSingle v-bind="{ product }"/>
        <!--  -->
        <!-- testimonial -->
        <ProductTestimonials v-if="product.reviews.length > 0" v-bind="{ product }"/>
        <!-- /testimonial -->
        <!-- related products -->
        <ProductRelatedProducts v-if="product.related.length > 0" v-bind="{ product }"/>
        <SimilarProductsWithPrint
            v-if="productsWithSimilarPrint.length > 0"
            :products-with-similar-print="productsWithSimilarPrint"/>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="additional-info mt-5 mb-5 text-center">
                        ID: {{ product.id }} | {{ __('product.views') }}:
                        {{ visits }}
                    </div>
                </div>
            </div>
        </div>
        <!-- newsletter -->
        <SectionNewsletter/>
        <!-- /newsletter -->
    </div>
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/layouts/Breadcrumbs.vue';
import QuickView from '@/Components/Shop/Products/QuickView.vue';
import ProductTestimonials from '@/Components/Shop/Product/ProductTestimonials.vue';
import ProductRelatedProducts from '@/Components/Shop/Product/ProductRelatedProducts.vue';
import SimilarProductsWithPrint from '@/Components/Shop/Product/SimilarProductsWithPrint.vue';
import ProductSingle from '@/Components/Shop/Product/ProductSingle.vue';
import SectionNewsletter from '@/Components/Main/SectionNewsletter.vue';

export default {
    name: 'Product',
    components: {
        Link,
        Head,
        Breadcrumbs,
        QuickView,
        ProductTestimonials,
        ProductRelatedProducts,
        SimilarProductsWithPrint,
        ProductSingle,
        SectionNewsletter,
    },
    provide() {
        return {
            similarProducts: this.similarProducts,
            productSizes: this.productSizes,
            productColors: this.productColors,
        };
    },
    layout: [BaseLayout],
    props: {
        product: Object,
        productsWithSimilarPrint: Array,
        similarProducts: Array,
        visits: Number,
        productColors: Array,
        productSizes: Array,
    },
    data: function() {
        return {
            breadcrumbs: [
                {icon: 'ti-home', to: this.route('index')},
                {
                    label: this.__('main.menu.shop'),
                    to: route('products.index'),
                },
                {
                    label: this.product.name,
                    to: route('products.show', this.product.id),
                },
            ],
        };
    },
    computed: {
        title() {
            return this.product.name;
        },
    },
    mounted() {
        console.log('product:', this.product);
    },
};
</script>

<style>
html {
    scroll-behavior: smooth;
}
</style>
