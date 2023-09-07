<template>
    <template v-if="!product.added_in_wishlist">
        <a
            href="#"
            data-toggle="tooltip"
            :title="__('product.add_to_wishlist')"
            data-original-title="Wishlist"
            data-placement="left"
            v-bind="{
                  ...$attrs,
                  }"
            @click.prevent="addToWishlist"
        ><i class="ti-heart"></i
        ></a>
    </template>
    <template v-else>
        <a
            href="#"
            data-toggle="tooltip"
            :title="__('product.remove_from_wishlist')"
            data-original-title="Wishlist"
            data-placement="left"
            v-bind="{
                  ...$attrs,
                  }"
            @click.prevent="removeFromWishlist"
        ><i class="ti-heart-broken text-primary"></i
        ></a>
    </template>
</template>

<script>
import product from '@/Mixins/product.js';

export default {
    name: 'WishlistButton',
    mixins: [product],
    props: {
        size: {
            type: Number,
            default: 18,
        },
        product: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style scoped>

</style>
