<template>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">{{ __('top_categories') }}</h2>
                </div>
                <!-- categories item -->
                <div v-for="(category, key) in categories" :key="key" class="col-lg-4 col-md-6 mb-50">
                    <CategoryItem
                        :name="category.name"
                        :img="category.img"
                        :children="category.children"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import CategoryItem from '@/Components/Main/CategoryItem.vue';

export default {
    name: 'SectionCategories',
    components: {
        CategoryItem,
    },
    props: {
        categories: Array,
    },
};
</script>

<style scoped>

</style>
