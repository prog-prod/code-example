<template>
    <div class="product-slider">
        <div class="product-slider__large">
            <swiper
                style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                class="swiper-container mySwiper2"
                :modules="modulesSwiperMain"
                :zoom="true"
                :thumbs="{ swiper: thumbsSwiper }"
                :space-between="10"
                :navigation="true"
                :slides-per-view="1"
                :speed="500"
                :autoplay="false"
                :loop="true"
                :pagination="false"
            >
                <swiper-slide v-if="product.images.length === 0">
                    <img
                        class="img-fluid w-100 image-zoom"
                        :src="asset(defaultProductImg)"
                        alt="product-img"
                        :data-zoom="asset(defaultProductImg)"/>
                </swiper-slide>
                <swiper-slide v-for="(image, key) in product.images" v-else :key="key" class="slider-item">
                    <div class="swiper-zoom-container">
                        <picture>
                            <img
                                class="lazy loaded" :src="assetStorage(image.filename)"
                                :data-src="assetStorage(image.filename)"
                                loading="lazy"
                                :alt="product.name" data-was-processed="true">
                        </picture>
                    </div>
                </swiper-slide>
            </swiper>
        </div>
        <div class="product-slider__secondary">
            <swiper
                class="swiper-container mySwiper"
                :space-between="10"
                :modules="modulesSwiperThumb"
                :slides-per-view="6"
                :speed="1000"
                :free-mode="true"
                :watch-slides-progress="true"
                :loop="false"
                @swiper="setThumbsSwiper"
            >
                <swiper-slide v-if="product.images.length === 0">
                    <img
                        class="img-fluid w-100 image-zoom"
                        :src="asset(defaultProductImg)"
                        alt="product-img"
                        :data-zoom="asset(defaultProductImg)"/>
                </swiper-slide>
                <swiper-slide v-for="(image, key) in product.images" v-else :key="key" class="slider-item">
                    <picture>
                        <img
                            class="lazy loaded" :src="assetStorage(image.filename)"
                            :data-src="assetStorage(image.filename)"
                            loading="lazy"
                            :alt="product.name" data-was-processed="true">
                    </picture>
                </swiper-slide>
            </swiper>
        </div>
    </div>
</template>

<script>
import product from '@/Mixins/product.js';
import {Link} from '@inertiajs/vue3';
import {Swiper, SwiperSlide} from 'swiper/vue';
import {FreeMode, Navigation, Thumbs, Zoom} from 'swiper';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/thumbs';
import 'swiper/css/zoom';

export default {
    name: 'ProductSlider',
    components: {SwiperSlide, Swiper, Link},
    mixins: [
        product,
    ],
    props: {
        product: Object,
    },
    data: () => ({
        thumbsSwiper: null,
        modulesSwiperMain: [Zoom, FreeMode, Navigation, Thumbs],
        modulesSwiperThumb: [FreeMode, Navigation, Thumbs],
    }),
    methods: {
        setThumbsSwiper(swiper) {
            this.thumbsSwiper = swiper;
        },
    },
};
</script>

<style lang="scss">
.product-slider {
    .swiper-button-prev,
    .swiper-button-next {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        background: rgba(255, 65, 53, .5);
        color: #fff;
        border: 0;
        line-height: 50px;
        transition: all linear .2s;
        opacity: 0;

        &::after {
            font-size: 16px;
        }

        &:hover {
            background: rgba(255, 65, 53, .8);
        }
    }

    .swiper-button-prev {
        left: -20px;
    }

    .swiper-button-next {
        right: -20px;
    }

    &:hover {
        .swiper-button-prev,
        .swiper-button-next {
            opacity: 1;
        }

        .swiper-button-prev {
            left: 20px;
        }

        .swiper-button-next {
            right: 20px;
        }
    }
}

.swiper-container {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}

.swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.swiper-container {
    width: 100%;
    height: 300px;
    margin-left: auto;
    margin-right: auto;
}

.swiper-slide {
    background-size: cover;
    background-position: center;
}

.mySwiper {
    height: 80%;
    width: 100%;
}

.mySwiper2 {
    height: 20%;
    box-sizing: border-box;
    padding: 10px 0;
}

.mySwiper2 swiper-slide {
    width: 25%;
    height: 100%;
    opacity: 0.4;
}

.mySwiper2 .swiper-slide-thumb-active {
    opacity: 1;
}

.swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.slick-dots > * {
    flex-basis: 0;
    flex-grow: 1;
}
</style>
