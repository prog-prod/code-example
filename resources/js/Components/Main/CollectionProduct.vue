<template>
    <div class="product text-center">
        <div class="product-thumb">
            <div class="overflow-hidden position-relative">
                <Link :href="route('products.show', 1)">
                    <template v-for="(image, key) in product.images">
                        <img
                            class="img-fluid w-100 mb-3" :class="key === 0 ? 'img-first' : 'img-second'"
                            :src="assetStorage(`${image.filename}`)" alt="product-img">
                    </template>
                </Link>
                <div class="btn-cart">
                    <a href="#" class="btn btn-primary btn-sm">{{ __('main.add_to_cart') }}</a>
                </div>
            </div>
            <div class="product-hover-overlay">
                <a
                    href="#" class="product-icon favorite" data-toggle="tooltip"
                    data-placement="left" title="Wishlist"><i class="ti-heart"></i></a>
                <a
                    href="#" class="product-icon cart" data-toggle="tooltip"
                    data-placement="left" title="Compare"><i
                    class="ti-direction-alt"></i></a>
                <a
                    data-vbtype="inline" href="#quickView" class="product-icon view venobox"
                    data-toggle="tooltip" data-placement="left" title="Quick View"><i
                    class="ti-search"></i></a>
            </div>
        </div>
        <div class="product-info">
            <h3 class="h5">
                <Link class="text-color" :href="route('products.show', 1)">{{ product.name }}</Link>
            </h3>
            <span class="h5">{{ product.price }}</span>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'CollectionProduct',
    components: {
        Link,
    },
    props: {
        product: Object,
    },
};
</script>

<style scoped>

</style>
