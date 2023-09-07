<template>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="mb-4">{{ __('product.related-print.title') }}</h2>
                </div>
                <Slider>
                    <swiper-slide v-for="(related_product, key) in productsWithSimilarPrint" :key="key">
                        <Product :product="related_product"/>
                    </swiper-slide>
                </Slider>

            </div>
        </div>
    </section>
</template>

<script>
import Slider from '@/Components/UI/Slider.vue';
import {SwiperSlide} from 'swiper/vue';
import Product from '@/Components/Shop/Products/Product.vue';

export default {
    name: 'SimilarProductsWithPrint',
    components: {
        Slider,
        SwiperSlide,
        Product,
    },
    props: {
        productsWithSimilarPrint: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style scoped>

</style>
