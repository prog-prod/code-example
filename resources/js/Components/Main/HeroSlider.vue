<template>
    <div>
        <swiper
            :modules="modules"
            :slides-per-view="1"
            :space-between="50"
            :speed="slider.speed"
            :autoplay="autoplay"
            :loop="!!slider.infinite"
            :pagination="{ clickable: true }"
        >
            <swiper-slide v-for="(slide,key) in slider.slides" :key="key" class="slider-item">
                <Link :href="slide.link_url">
                    <picture>
                        <source
                            media="(max-width: 960px)"
                            :srcset="assetStorage(slide.image_webp_mobile)"
                            :data-srcset="assetStorage(slide.image_webp_mobile)" type="image/webp">
                        <source
                            media="(max-width: 960px)"
                            :srcset="assetStorage(slide.image_jpg_mobile)"
                            :data-srcset="assetStorage(slide.image_jpg_mobile)" type="image/jpeg">
                        <source
                            :srcset="assetStorage(slide.image_webp_desktop)"
                            :data-srcset="assetStorage(slide.image_webp_desktop)" type="image/webp">
                        <source
                            :srcset="assetStorage(slide.image_jpg_desktop)"
                            :data-srcset="assetStorage(slide.image_jpg_desktop)" type="image/jpeg">
                        <img
                            class="lazy loaded" :src="assetStorage(slide.image_jpg)"
                            :data-src="assetStorage(slide.image_jpg)"
                            loading="lazy"
                            :alt="slide.title" data-was-processed="true">
                    </picture>
                </Link>
            </swiper-slide>
        </swiper>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';
// import Swiper core and required modules
// Import Swiper Vue.js components
import {Swiper, SwiperSlide} from 'swiper/vue';
import {A11y, Autoplay, Navigation, Pagination, Scrollbar} from 'swiper';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';

export default {
    components: {
        Link,
        Swiper,
        SwiperSlide,
    },
    props: {
        slider: Object,
    },
    data: () => ({
        modules: [Navigation, Pagination, Scrollbar, A11y, Autoplay],
        autoplay: {},
    }),
    mounted() {
        console.log('slider', this.slider);
        this.autoplay = {
            delay: this.slider?.autoplay_speed,
            disableOnInteraction: this.slider?.pause_on_focus,
            pauseOnMouseEnter: this.slider?.pause_on_hover,
        };
    },
};
</script>

