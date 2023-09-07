<template>
    <div>
        <Head :title="__('products.head')"/>
        <Breadcrumbs v-bind="{breadcrumbs}"/>
        <QuickView/>
        <!-- shop -->
        <section class="section">
            <div class="container-fluid">
                <div class="row">
                    <!-- top bar -->
                    <div class="col-lg-12">
                        <TopBar :products-meta="products.meta"/>
                    </div>
                </div>
                <div class="content-box">
                    <div class="left-box">
                        <!-- sidebar -->
                        <ProductsSidebar v-bind="{categories, filters}"/>
                    </div>
                    <div class="right-box">
                        <!-- product-list -->
                        <ProductList :products="productsData" :meta="products.meta" :links="products.links"/>
                    </div>
                </div>
            </div>
        </section>
        <!-- /shop -->
        <SectionNewsletter/>
        <MobileFiltersCurtain v-bind="{categories, filters}"/>
    </div>
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import QuickView from '@/Components/Shop/Products/QuickView.vue';
import TopBar from '@/Components/Shop/Products/TopBar.vue';
import ProductsSidebar from '@/Components/Shop/Products/ProductsSidebar.vue';
import ProductList from '@/Components/Shop/Products/ProductList.vue';
import Breadcrumbs from '@/Components/layouts/Breadcrumbs.vue';
import SectionNewsletter from '@/Components/Main/SectionNewsletter.vue';
import MobileFiltersCurtain from '@/Pages/Shop/MobileFiltersCurtain.vue';
import {mapActions, mapGetters} from 'vuex';

export default {
    name: 'Products',
    components: {
        MobileFiltersCurtain,
        SectionNewsletter,
        Link,
        Head,
        QuickView,
        TopBar,
        ProductsSidebar,
        ProductList,
        Breadcrumbs,
    },
    layout: [BaseLayout],
    props: {
        products: Array,
        categories: Array,
        category: Object,
        filters: Object,
    },
    computed: {
        ...mapGetters({
            productsData: 'products/productsData',
        }),
        breadcrumbs() {
            const breadcrumbs = [
                {icon: 'ti-home', to: this.route('index')},
                {label: this.__('main.menu.shop'), to: this.route('products.index')},
            ];
            this.category && breadcrumbs.push({
                label: this.category.name,
                to: this.route(this.route().current(), this.route().params),
            });

            return breadcrumbs;
        },
    },
    mounted() {
        this.setProductsData(this.products.data);
    },
    methods: {
        ...mapActions({
            setProductsData: 'products/setProductsData',
        }),
    },
};
</script>

<style lang="scss" scoped>
.content-box {
    display: flex;
    flex-wrap: nowrap;
    justify-content: flex-end;
    align-items: flex-start;

    .left-box {
        width: 275px;
        min-width: 275px;
        padding-left: 25px;
        padding-bottom: 25px;

        @media (max-width: 991px) {
            display: none;
        }
    }

    .right-box {
        width: 100%;
        padding-left: 50px;
        padding-right: 20px;
        @media (max-width: 991px) {
            padding-left: 0px;
            padding-right: 0px;
        }
    }
}
</style>
<style>
.top-banner {
    width: 100%;
    height: 300px;

}
</style>
