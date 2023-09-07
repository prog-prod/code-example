<template>
    <section
        class="section bg-cover"
        style="background-image: url(images/deal.jpg)"
    >
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
                    <h1>{{ title }}</h1>
                    <h4 class="mb-4">{{ product.name }}</h4>
                    <h4 class="mb-40">{{ description }}</h4>
                    <!-- syo-timer -->
                    <ProductSaleTimer
                        v-bind="{ product }"
                        large
                    ></ProductSaleTimer>
                    <Link
                        :href="route('products.show', { product: product.id })"
                        class="btn btn-primary"
                    >{{ __('main.sale_btn') }}
                    </Link>
                </div>
                <div
                    class="col-md-4 text-center text-md-left align-self-center"
                >
                    <Product class="img-fluid up-down" v-bind="{ product }" :is-large-preview="true"/>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {Link} from '@inertiajs/vue3';
import product from '@/Mixins/product.js';
import Product from '@/Components/Shop/Products/Product.vue';
import ProductSaleTimer from '@/Components/Shop/Product/ProductSaleTimer.vue';

export default {
    name: 'SectionDeal',
    components: {
        Link,
        Product,
        ProductSaleTimer,
    },
    mixins: [product],
    props: {
        product: Object,
        title: String,
        description: String,
    },
    computed: {
        percent() {
            return this.product.sale ? `${this.product.sale.percent}%` : null;
        },
    },
    methods: {},
};
</script>

<style scoped></style>
