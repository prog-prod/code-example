<template>
    <div class="col-12">
        <swiper
            class="collection-slider"
            :modules="modules"
            :slides-per-view="slidesToShow"
            :space-between="50"
            :pagination="{ clickable: true }"
            :breakpoints="breakpointsComputed"
            @swiper="onSwiper"
            @slideChange="onSlideChange"
        >
            <slot></slot>
        </swiper>
    </div>
</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';
import {A11y, Navigation, Pagination, Scrollbar} from 'swiper';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import {Link} from '@inertiajs/vue3';

export default {
    name: 'Slider',
    components: {
        Link,
        Swiper,
        SwiperSlide,
    },
    props: {
        breakpoints: {
            type: Object,
            required: false,
        },
        dots: {
            type: Boolean,
            default: true,
        },
        speed: {
            type: Number,
            default: 300,
        },
        autoplay: {
            type: Number,
            default: 1,
        },
        autoplaySpeed: {
            type: Number,
            default: 5e3,
        },
        arrows: {
            type: Number,
            default: 0,
        },
        slidesToShow: {
            type: Number,
            default: 4,
        },
        slidesToScroll: {
            type: Number,
            default: 4,
        },
        responsive: {
            type: Array,
            default: () => [{breakpoint: 1024, settings: {slidesToShow: 3, slidesToScroll: 3}}, {
                breakpoint: 768,
                settings: {slidesToShow: 2, slidesToScroll: 2},
            }, {breakpoint: 480, settings: {slidesToShow: 1, slidesToScroll: 1}}],
        },
    },
    data: () => ({
        modules: [Navigation, Pagination, Scrollbar, A11y],
        breakpointsDefault: {
            // when window width is >= 320px
            120: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            320: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            // when window width is >= 640px
            640: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
        },
    }),
    computed: {
        breakpointsComputed() {
            return this.breakpoints || this.breakpointsDefault;
        },
    },
    mounted() {
        this.breakpointsDefault[640].slidesPerView = this.slidesToShow;
    },
};
</script>

<style lang="scss" scoped>

:deep(.collection-slider) {
    .swiper-pagination {
        margin-top: 20px;
        position: static;
    }
}
</style>
