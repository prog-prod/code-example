<template>
    <Link :href="productLink" :class="{'tile__picture': !isLarge}">
        <template v-if="onlyMain">
            <img
                class="img-fluid img-first"
                :src="productImage(product.main_image?.filename)"
                alt="product-img"
            />
        </template>
        <template v-else>
            <template v-for="(image, key) in images" :key="key">
                <img
                    class="img-fluid"
                    :class="key === 0 ? 'img-first' : 'img-second'"
                    :src="productImage(image.filename)"
                    alt="product-img"
                />
            </template>
        </template>
    </Link>
</template>

<script>
import {Link} from '@inertiajs/vue3';
import product from '@/Mixins/product.js';

export default {
    name: 'ProductImage',
    components: {
        Link,
    },
    mixins: [product],
    props: {
        isLarge: {
            type: Boolean,
            default: false,
        },
        product: {
            type: Object,
            required: true,
        },
        onlyMain: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        images() {
            return this.product.images.slice(0, 2);
        },
    },
};
</script>

<style lang="scss" scoped>

.tile__picture {
    position: relative;
    display: block;
    height: 270px;
    margin-bottom: 16px;
    text-align: center;

    img {
        width: auto;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-height: 270px;
        vertical-align: middle;
    }
}
</style>
