<template>
    <section class="homeslider">
        <HeroSlider :slider="heroSlider"/>
    </section>
</template>

<script>
import HeroSlider from '@/Components/Main/HeroSlider.vue';

export default {
    name: 'SectionHero',
    components: {
        HeroSlider,
    },
    props: {
        heroSlider: Object,
    },
};
</script>

<style lang="scss" scoped>
.homeslider {
    max-width: 1920px;
    margin-left: auto;
    margin-right: auto;

    :deep(.swiper-slide img) {
        vertical-align: top;
        max-width: 100%;
    }
}
</style>
