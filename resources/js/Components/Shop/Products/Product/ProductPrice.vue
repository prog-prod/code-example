<template>
    <div class="product__prices">
        <div :class="{'invisible':!priceWithDiscount}" class="product__price-old">
                            <span>
                                {{ price }}
                                <span class="currency">{{ currency }}</span>
                            </span>
        </div>
        <div :class="{'product__price_color_red': priceWithDiscount}" class="product__price">
            {{ priceWithDiscount ? priceWithDiscount : price }}
            <span class="product__price-currency currency">
                {{ currency }}
            </span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductPrice',
    props: {
        price: Number,
        currency: String,
        priceWithDiscount: Number,
    },
};
</script>

<style lang="scss" scoped>
.product__price-old {
    position: relative;
    display: inline-block;
    font-size: 14px;
    line-height: 1;
    text-decoration: line-through;
    color: #a6a5a5;
}

.product__prices {
    text-align: left;

    > div {
        min-width: 60px;
    }
}

.product__price {
    font-size: 24px;
}

.currency {
    margin-left: 4px;
}

.product__price-currency {
    font-size: 18px;
}

.product__price_color_red {
    color: #f84147;
}
</style>
