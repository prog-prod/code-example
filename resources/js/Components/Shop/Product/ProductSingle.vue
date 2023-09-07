<template>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <!-- product image slider -->
                    <ProductSlider v-bind="{product}"/>
                </div>
                <!-- product details -->
                <div class="col-lg-6 mb-100">
                    <ProductDetails v-bind="{product}"/>
                </div>
                <div class="col-lg-12">
                    <ProductDescription v-bind="{product}"/>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import ProductSlider from '@/Components/Shop/Product/ProductSlider.vue';
import ProductDetails from '@/Components/Shop/Product/ProductDetails.vue';
import ProductDescription from '@/Components/Shop/Product/ProductDescription.vue';

export default {
    name: 'ProductSingle',
    components: {
        ProductSlider,
        ProductDetails,
        ProductDescription,
    },
    props: {
        product: Object,
    },
};
</script>

<style scoped>

</style>
