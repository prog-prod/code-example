<template>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="mb-4">{{ __('product.related.title') }}</h2>
                </div>
                <Slider>
                    <swiper-slide v-for="(related_product, key) in product.related" :key="key">
                        <Product :product="related_product"/>
                    </swiper-slide>
                </Slider>

            </div>
        </div>
    </section>
</template>

<script>
import Product from '@/Components/Shop/Products/Product.vue';
import Slider from '@/Components/UI/Slider.vue';
import {SwiperSlide} from 'swiper/vue';

export default {
    name: 'ProductRelatedProducts',

    components: {
        Product,
        Slider,
        SwiperSlide,
    },
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style scoped></style>
