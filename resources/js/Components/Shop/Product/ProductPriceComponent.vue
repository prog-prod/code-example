<template>
    <template v-if="product.sale">
        <h4 class="text-primary h3">
            {{ productActualPrice }} {{ currency }}
            <s class="text-color ml-2">{{ productPrice }} {{ currency }}</s>
        </h4>
    </template>
    <template v-else>
        <h4 class="text-color h3">{{ productPrice }} {{ currency }}</h4>
    </template>

    <h6 v-if="product.sale && !noEconomyText" class="mb-4">
        {{ __('product.details.you_save') }}:
        <span class="text-primary"
        >{{ discountPrice }} {{ currency }} ({{
                discountPercent
            }}%)</span
        >
    </h6>
</template>

<script>
import {CurrencyService} from '@/Services/CurrencyService.ts';

export default {
    name: 'ProductPriceComponent',
    props: {
        product: {
            type: Object,
            required: true,
        },
        quantity: {
            type: Number,
        },
        noEconomyText: {
            type: Boolean,
            default: false,
        },
    },
    data: () => ({
        scopedQuantity: 1,
    }),
    computed: {
        discountPercent() {
            return this.product.sale?.percent;
        },
        discountPrice() {
            return this.product.discount
                ? this.product.discount.amount * this.scopedQuantity
                : 0;
        },
        currency() {
            return this.product.price.symbol;
        },
        currencyService() {
            return new CurrencyService();
        },
        productActualPrice() {
            return this.currencyService.calcSubTotalDiscount({
                product: this.product,
                quantity: this.scopedQuantity,
            });
        },
        productPrice() {
            return this.product.price.amount * this.scopedQuantity;
        },
    },
    watch: {
        quantity() {
            if (this.quantity === 0) {
                this.scopedQuantity = 1;
            } else {
                this.scopedQuantity = this.quantity;
            }
        },
    },
};
</script>

<style scoped>

</style>
