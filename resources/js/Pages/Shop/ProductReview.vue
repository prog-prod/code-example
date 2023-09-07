<template>
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <Slider slides-to-show="6" :breakpoints="breakpointsSlider">
                    <swiper-slide v-for="(item,key) in orderItems" :key="key">
                        <Product :product="item.product"></Product>
                    </swiper-slide>
                </Slider>
            </div>
        </div>
    </div>
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import Product from '@/Components/Shop/Products/Product.vue';
import Slider from '@/Components/UI/Slider.vue';
import {SwiperSlide} from 'swiper/vue';

export default {
    name: 'ProductReview',
    components: {Slider, Product, SwiperSlide},
    layout: [BaseLayout],
    props: {
        order: {
            type: Object,
        },
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
                slidesPerView: 4,
                spaceBetween: 40,
            },
            '@1.50': {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    }),
    computed: {
        orderItems() {
            return this.order.items;
        },
    },
    mounted() {
        console.log(this.order);
    },
};
</script>

<style scoped>

</style>
