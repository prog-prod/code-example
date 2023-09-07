<template>
    <div>
        <template v-if="product.sale">
            <div class="product-label sale">
                -{{ product.sale.percent }}%
            </div>
        </template>
        <template v-if="product.is_new">
            <div class="product-label new" :class="{'below': product.sale}">
                new
            </div>
        </template>
    </div>
</template>

<script>
export default {
    name: "ProductLabelBadge",
    props: {
        product: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
