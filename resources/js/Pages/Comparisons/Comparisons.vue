<template>
    <div>
        <Head :title="__('products.head')"/>
        <Breadcrumbs v-bind="{breadcrumbs}"/>
        <section class="section">
            <div class="container">
                <template v-if="comparisons.data.length > 0">
                    <ComparisonsList :products="comparisons.data" :meta="comparisons.meta" :links="comparisons.links"/>
                </template>
                <div v-else class="text-center">{{ __('comparisons.no_comparisons') }}</div>
            </div>
        </section>
    </div>
</template>

<script>
import Breadcrumbs from '@/Components/layouts/Breadcrumbs.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import ComparisonsList from '@/Components/Comparisons/ComparisonsList.vue';

export default {
    name: 'Comparisons',
    components: {
        Breadcrumbs,
        ComparisonsList,
    },
    layout: [BaseLayout],
    props: {
        comparisons: {
            type: Object,
        },
    },
    computed: {
        breadcrumbs() {
            return [
                {icon: 'ti-home', to: this.route('index')},
                {label: this.__('main.comparisons'), to: this.route('comparisons.index')},
            ];
        },
    },
};
</script>

<style scoped>

</style>
