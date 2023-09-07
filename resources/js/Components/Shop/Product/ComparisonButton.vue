<template>
    <template v-if="!product.added_in_comparisons">
        <a
            href="#"
            data-toggle="tooltip"
            :title="__('product.add_to_comparisons')"
            data-original-title="Compare"
            data-placement="left"
            v-bind="{
                  ...$attrs,
                  }"
            @click.prevent="addToComparisons"
        >
            <ScaleIcon :width="size" :height="size"/>
        </a>
    </template>
    <template v-else>
        <a
            href="#"
            data-toggle="tooltip"
            :title="__('product.remove_from_comparisons')"
            data-original-title="Compare"
            data-placement="left"
            v-bind="{
                  ...$attrs,
                  }"
            @click.prevent="removeFromComparisons"
        >
            <ScaleCrossOutIcon :width="size" :height="size" class="text-primary"/>
        </a>
    </template>
</template>

<script>
import product from '@/Mixins/product.js';
import ScaleIcon from '@/Components/Icons/ScaleIcon.vue';
import ScaleCrossOutIcon from '@/Components/Icons/ScaleCrossOutIcon.vue';

export default {
    name: 'WishlistButton',
    components: {
        ScaleCrossOutIcon,
        ScaleIcon,
    },
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

<style lang="scss">
svg.text-primary {
    path, line {
        fill: #ff4135;
    }
}
</style>
