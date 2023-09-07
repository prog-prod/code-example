<template>
    <div v-if="children.length > 0" class="card p-0">
        <div class="border-bottom text-center hover-zoom-img">
            <Link
                :href="route('category.show',children[0].key)"
                :title="children[0].name"><img
                :src="isAbsoluteLink(children[0].image) ? children[0].image : assetStorage(children[0].image)"
                class="rounded-top img-fluid w-100" alt="product-img">
            </Link>
        </div>
        <ul class="d-flex list-unstyled pl-0 categories-list">
            <li v-for="(child,key) in children.slice(1)" :key="key" class="m-0 hover-zoom-img">
                <Link :href="route('category.show',child.key)" :title="child.name"><img
                    :src="isAbsoluteLink(child.image) ? child.image : assetStorage(child.image)"
                    class="img-fluid w-100" alt="product-img"></Link>
            </li>
        </ul>
        <div class="px-4 py-3 border-top">
            <h4 class="d-inline-block mb-0 mt-1">{{ name }}</h4>
            <Link :href="route('products.index')" class="btn btn-sm btn-outline-primary float-right">view
                more
            </Link>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'CategoryItem',
    components: {
        Link,
    },
    props: {
        name: String,
        img: String,
        children: Array,
    },
};
</script>

<style scoped>

</style>
