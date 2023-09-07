<template>
    <div class="categories-filter mb-30">
        <h4 class="mb-3">{{ __('products.filter.category.title') }}</h4>
        <ul class="pl-0 shop-list list-unstyled">
            <template v-for="(category, key1) in categories" :key="key1">
                <li>
                    <Link
                        :href="category.url"
                        :preserve-scroll="true"
                        class="category d-flex py-2 text-gray justify-content-between"
                    >
                        <span
                            :class="{
                                active:
                                    category.key === route().params.category,
                            }"
                        >{{ category.name }}</span
                        >
                        <span>{{
                                (category.products_count || 0) + countChildrenProducts(category.children)
                            }}</span>
                    </Link>
                    <div
                        v-if="category.children.length > 0"
                        class="category-children"
                    >
                        <template
                            v-for="(child_category, key2) in category.children"
                            :key="key2"
                        >
                            <Link
                                :href="child_category.url"
                                :preserve-scroll="true"
                                class="d-flex py-2 text-gray justify-content-between"
                            >
                                <span
                                    :class="{
                                        active:
                                            child_category.key ===
                                            route().params.category,
                                    }"
                                >{{ child_category.name }}</span
                                >
                                <span>{{ child_category.products_count || 0 }}</span>
                            </Link>
                        </template>
                    </div>
                </li>
            </template>
        </ul>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'CategoriesFilter',
    components: {
        Link,
    },
    props: {
        categories: {
            type: Array,
            required: true,
        },
    },
    methods: {
        countChildrenProducts(children) {
            return children.reduce((accumulator, item) => {
                const count = item.products_count || 0;
                return accumulator + count;
            }, 0);
        },
    },
};
</script>

<style scoped>
.active {
    color: #ff4135;
}

.category-children {
    padding-left: 10px;
}
</style>
