<template>
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">{{ __('main.top_collections') }}</h2>
                </div>
                <Slider slides-to-show="6" :breakpoints="breakpointsSlider">
                    <swiper-slide v-for="(product,key) in products" :key="key">
                        <Product v-bind="{product, key}"></Product>
                    </swiper-slide>
                </Slider>
            </div>
        </div>
        <QuickView/>
    </section>
</template>

<script>
import QuickView from '@/Components/Shop/Products/QuickView.vue';
import Product from '@/Components/Shop/Products/Product.vue';
import Slider from '@/Components/UI/Slider.vue';
import {SwiperSlide} from 'swiper/vue';

export default {
    name: 'SectionCollections',
    components: {
        QuickView,
        Product,
        Slider,
        SwiperSlide,
    },
    props: {
        products: Array,
    },
    data: () => ({
        breakpointsSlider: {
            '@0.00': {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            '@0.75': {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            '@1.00': {
                slidesPerView: 5,
                spaceBetween: 40,
            },
            '@1.50': {
                slidesPerView: 6,
                spaceBetween: 50,
            },
        },
    }),
};
</script>

<style scoped>

</style>
