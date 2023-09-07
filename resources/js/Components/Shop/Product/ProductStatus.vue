<template>
    <div class="product__availability">
        <template v-if="product.stock_quantity > 0">
            <i class="ti-check-box text-success mr-2"></i>
            <span class="text-success">{{
                    __('product.details.instock')
                }}</span>
        </template>
        <template v-else>
            <i class="ti-face-sad text-muted mr-2"></i>
            <span class="text-muted">{{
                    __('product.details.out_of_stock')
                }}</span>
        </template>
    </div>

</template>

<script>
export default {
    name: 'ProductStatus',
    props: {
        product: Object,
        required: true,
    },
};
</script>

<style scoped>

</style>
