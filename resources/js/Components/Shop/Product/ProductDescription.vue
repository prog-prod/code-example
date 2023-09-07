<template>
    <div class="product__description">
        <template v-if="product.description">
            <h3 class="mb-3 mt-5">{{ __('product.description.title') }}</h3>
            <p class="text-gray" v-html="product.description"></p>
        </template>
        <template v-if="product.features.length > 0">
            <h4 class="mt-4">{{ __('product.description.features.title') }}:</h4>
            <ul class="features-list">
                <template v-for="(feature, key) in product.features" :key="key">
                    <li>{{ feature.name ? `${feature.name}: ` : '' }}{{ feature.text }}</li>
                </template>
            </ul>
        </template>
    </div>
</template>

<script>
export default {
    name: 'ProductDescription',
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style scoped>
.product__description {
    overflow-x: auto;
}
</style>
