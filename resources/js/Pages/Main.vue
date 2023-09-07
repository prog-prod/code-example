<template>
    <div>
        <Head v-bind="{title}">
            <meta name="keywords" :content="meta.keywords"/>
            <meta name="description" :content="meta.description"/>
        </Head>
        <template v-for="(section, key) in sections" :key="key">
            <SectionHero
                v-if="section.active === '1' && section.key === SectionsEnum.HERO_SLIDER && heroSlider.slides.length > 0"
                :hero-slider="heroSlider"/>
            <SectionCategories
                v-if="section.active === '1' && section.key === SectionsEnum.TOP_CATEGORIES && categories.length > 0"
                v-bind="{categories}"/>
            <SectionSale
                v-if="section.active === '1' && section.key === SectionsEnum.SALE" :key="`sale-${key}`"
                :title="page.sale_title"
                :bg-image="section.image"
                :text="page.sale_text"/>
            <SectionCollections
                v-if="section.active === '1' && section.key === SectionsEnum.BEST_COLLECTIONS && section.products?.length > 0"
                :products="section.products"/>
            <SectionDeal
                v-if="section.active === '1' && section.key === SectionsEnum.DEAL && section.product"
                :title="page.deal_title"
                :description="page.deal_description"
                :product="section.product"/>
            <SectionInstagram
                v-if="section.active === '1' && section.key === SectionsEnum.INSTAGRAM"/>
            <SectionService
                v-if="section.active === '1' && section.key === SectionsEnum.SERVICE"/>
            <SectionNewsletter
                v-if="section.active === '1' && section.key === SectionsEnum.SUBSCRIPTION"/>
        </template>
    </div>
</template>

<script>

import BaseLayout from '@/Layouts/BaseLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import SectionSale from '@/Components/Main/SectionSale.vue';
import SectionCategories from '@/Components/Main/SectionCategories.vue';
import SectionHero from '@/Components/Main/SectionHero.vue';
import SectionCollections from '@/Components/Main/SectionCollections.vue';
import SectionDeal from '@/Components/Main/SectionDeal.vue';
import SectionInstagram from '@/Components/Main/SectionInstagram.vue';
import SectionService from '@/Components/Main/SectionService.vue';
import SectionNewsletter from '@/Components/Main/SectionNewsletter.vue';
import {SectionsEnum} from '@/enums/SectionsEnum.js';

export default {
    name: 'Main',
    components: {
        Link,
        SectionHero,
        SectionSale,
        SectionCategories,
        SectionCollections,
        SectionDeal,
        SectionInstagram,
        SectionService,
        SectionNewsletter,
        Head,
    },
    layout: [BaseLayout],
    props: {
        page: Object,
        heroSlider: Object,
        categories: Array,
        collectionProducts: Array,
        productDeal: Object,
    },
    data: () => ({
        SectionsEnum,
    }),
    computed: {
        meta() {
            return {
                keywords: this.page.meta_keywords,
                description: this.page.meta_description,
            };
        },
        title() {
            return this.page.meta_title;
        },
        sections() {
            return this.page.sections;
        },
    },
};
</script>

<style scoped>

</style>
