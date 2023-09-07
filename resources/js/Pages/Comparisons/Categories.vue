<template>
    <div>
        <Head :title="__('products.head')"/>
        <Breadcrumbs v-bind="{breadcrumbs}"/>
        <section class="section">
            <div class="container">
                <div v-if="categories.length > 0" class="categories-list">
                    <h3>{{ __('category') }}</h3>
                    <ul class="list-unstyled">
                        <template v-for="(category,key) in categories" :key="key">
                            <li>
                                <Link :href="route('comparisons.show', category.key)">{{ category.name }}</Link>
                            </li>
                        </template>
                    </ul>
                </div>
                <div v-else class="text-center">{{ __('comparisons.no_comparisons') }}</div>
            </div>
        </section>
    </div>
</template>

<script>
import Breadcrumbs from '@/Components/layouts/Breadcrumbs.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import ProductList from '@/Components/Shop/Products/ProductList.vue';
import {Link} from '@inertiajs/vue3';

export default {
    name: 'Categories',
    components: {
        Breadcrumbs,
        ProductList,
        Link,
    },
    layout: [BaseLayout],
    props: {
        categories: {
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
    mounted() {
        console.log('categories', this.categories);
    },
};
</script>

<style scoped>

</style>
