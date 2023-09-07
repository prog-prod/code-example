<template>
    <div>
        <!-- search product -->
        <div class="position-relative mb-5">
            <TextInput
                id="search-product"
                v-model="searchText"
                type="search"
                class="form-control rounded-0"
                :placeholder="`${__('products.filter.search.title')}...`"
                @keyup.enter="search"/>

            <button type="submit" class="search-icon pr-3 r-0" @click.prevent="search">
                <i class="ti-search text-color"></i>
            </button>
        </div>
        <div>
            <!-- categories -->
            <CategoryFilter v-bind="{categories}"/>
            <!-- price range -->
            <PriceFilter v-if="filters.price" :price="filters.price.values"/>
            <!-- size checkbox -->
            <SizeFilter v-if="filters.size" :sizes="filters.size.values"/>
            <!-- color selector -->
            <ColorFilter v-if="filters.colors" :colors="filters.colors"/>
        </div>
    </div>
</template>

<script>
import TextInput from '@/Components/TextInput.vue';
import {Link} from '@inertiajs/vue3';
import Collapse from '@/Components/Collapse.vue';
import PriceFilter from '@/Components/Shop/Products/Filters/PriceFilter.vue';
import CategoryFilter from '@/Components/Shop/Products/Filters/CategoryFilter.vue';
import SizeFilter from '@/Components/Shop/Products/Filters/SizeFilter.vue';
import ColorFilter from '@/Components/Shop/Products/Filters/ColorFilter.vue';

export default {
    name: 'ProductsSidebar',
    components: {
        Link,
        TextInput,
        Collapse,
        CategoryFilter,
        PriceFilter,
        SizeFilter,
        ColorFilter,
    },
    props: {
        categories: Array,
        filters: Object,
    },
    data: () => ({
        searchText: route().params.search || null,
        collapsedCategory: false,
    }),
    mounted() {
        console.log('filters', this.filters);
    },
    methods: {
        toggleCollapse() {
            this.collapsedCategory = !this.collapsedCategory;
            console.log(this.collapsedCategory);
        },
        search() {
            this.$search.search(this.searchText, true);
        },
    },
};
</script>

<style lang="scss" scoped>

</style>
