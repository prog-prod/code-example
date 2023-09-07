<template>
    <div>
        <Head :title="__('products.head')"/>
        <Breadcrumbs v-bind="{breadcrumbs}"/>
        <section class="section">
            <div class="container">
                <template v-if="wishlist.data.length > 0">
                    <ProductList :products="wishlist.data" :meta="wishlist.meta" :links="wishlist.links"/>
                </template>
                <div v-else class="text-center">{{ __('wishlist.empty_wishlist') }}</div>
            </div>
        </section>
    </div>
</template>

<script>
import Breadcrumbs from '@/Components/layouts/Breadcrumbs.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import ProductList from '@/Components/Shop/Products/ProductList.vue';

export default {
    name: 'Wishlist',
    components: {
        Breadcrumbs,
        ProductList,
    },
    layout: [BaseLayout],
    props: {
        wishlist: {
            type: Object,
        },
    },
    computed: {
        breadcrumbs() {
            return [
                {icon: 'ti-home', to: this.route('index')},
                {label: this.__('main.wishlist'), to: this.route('wishlist.index')},
            ];
        },
    },
};
</script>

<style scoped>

</style>
