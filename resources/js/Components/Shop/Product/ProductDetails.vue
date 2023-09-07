<template>
    <div>
        <h2>{{ product.name }}</h2>
        <ProductStatus v-bind="{ product }"/>
        <RatingComponent v-bind="{ product }" anchor="#product-testimonials"/>
        <ProductPriceComponent v-bind="{ product, quantity }"/>

        <div
            class="d-flex flex-column flex-sm-row justify-content-between mb-4"
        >
            <QuantityInput
                v-model="quantity"
                class="mr-2"
                is-large
                :max="product.stock_quantity"
            />
            <Dropdown
                v-if="colorOptions.length > 0"
                id="dropdown-color"
                v-model="selectedColor"
                class="form-control mr-sm-2"
                :placeholder="__('product.details.select_color')"
                :options="colorOptions"
                @change="updateProduct"
            >
                <template #selectedOption="{ option }">
                    <div class="d-flex gap-1">
                        <div class="align-self-center">
                            <div class="color-option" :style="getColorStyle(option)"/>
                        </div>
                        <div>{{ option?.label }}</div>
                    </div>
                </template>
                <template #option="{ option }">
                    <div class="d-flex gap-1">
                        <div class="align-self-center">
                            <div class="color-option" :style="getColorStyle(option)"/>
                        </div>
                        <div>{{ option?.label }}</div>
                    </div>
                </template>
            </Dropdown>
            <Dropdown
                v-if="sizeOptions.length > 0"
                id="dropdown-size"
                v-model="selectedSize"
                class="form-control"
                :placeholder="__('product.details.select_size')"
                :options="sizeOptions"
                @change="updateProduct"
            />

        </div>
        <div class="actions_container">
            <a href="#" class="btn btn-primary mb-4" @click.prevent="addToCart">
                {{ __('product.details.add_to_cart') }}
            </a>
            <WishlistButton v-bind="{ product }" style="font-size: 25px" class="actions_btn"/>
            <ComparisonButton v-bind="{ product }" :size="25" class="actions_btn"/>
        </div>


        <!-- SALE -->
        <template v-if="product.sale">
            <h4 class="mb-3">
                <span class="text-primary">{{
                        __('product.details.hurry_up')
                    }}</span>
                {{ __('product.details.sale_ends_in') }}
            </h4>
            <!-- syo-timer -->
            <ProductSaleTimer v-bind="{ product }" dark></ProductSaleTimer>
            <hr/>

        </template>
        <!-- /SALE -->

        <div class="payment-option border border-primary mt-5 mb-4">
            <h5 class="bg-white">
                {{ __('product.details.guaranteed_safe_checkout') }}
            </h5>
            <img
                class="img-fluid w-100 p-3"
                :src="asset('images/all-card.png')"
                alt="payment-card"
            />
        </div>
        <h5 class="mb-3">{{ __('product.details.reasons_to_buy_from_us') }}</h5>
        <div class="row">
            <!-- service item -->
            <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                <div class="d-flex">
                    <i class="ti-truck icon-md mr-3"></i>
                    <div class="align-items-center">
                        <h6>{{ __('product.details.reasons.free_shipping') }}</h6>
                    </div>
                </div>
            </div>
            <!-- service item -->
            <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                <div class="d-flex">
                    <i class="ti-shield icon-md mr-3"></i>
                    <div class="align-items-center">
                        <h6>{{ __('product.details.reasons.secure_payment') }}</h6>
                    </div>
                </div>
            </div>
            <!-- service item -->
            <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                <div class="d-flex">
                    <i class="ti-money icon-md mr-3"></i>
                    <div class="align-items-center">
                        <h6>{{ __('product.details.reasons.lowest_price') }}</h6>
                    </div>
                </div>
            </div>
            <!-- service item -->
            <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                <div class="d-flex">
                    <i class="ti-reload icon-md mr-3"></i>
                    <div class="align-items-center">
                        <h6>{{ __('product.details.reasons.30_days_return') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import QuantityInput from '@/Components/Cart/QuantityInput.vue';
import RatingComponent from '@/Components/UI/RatingComponent.vue';
import Dropdown from '@/Components/Dropdown.vue';
import ProductSaleTimer from '@/Components/Shop/Product/ProductSaleTimer.vue';
import ProductStatus from '@/Components/Shop/Product/ProductStatus.vue';
import ProductPriceComponent from '@/Components/Shop/Product/ProductPriceComponent.vue';
import cart from '@/Mixins/cart.js';
import productDetails from '@/Mixins/productDetails.js';
import WishlistButton from '@/Components/Shop/Product/WishlistButton.vue';
import ComparisonButton from '@/Components/Shop/Product/ComparisonButton.vue';
import {ProductService} from '@/Services/ProductService.ts';

export default {
    name: 'ProductDetails',
    components: {
        RatingComponent,
        QuantityInput,
        Dropdown,
        ProductSaleTimer,
        ProductStatus,
        ProductPriceComponent,
        ComparisonButton,
        WishlistButton,
    },
    mixins: [cart, productDetails],
    inject: ['similarProducts', 'productSizes', 'productColors'],
    props: {
        product: Object,
    },
    data: () => ({
        quantity: 1,
        selectedColor: null,
        selectedSize: null,
    }),
    computed: {
        productService() {
            return new ProductService(this.product);
        },
        sizeOptions() {
            return this.productSizes.map((size) => ({
                label: size.name,
                value: size.id,
            }));
        },
        colorOptions() {
            return this.productColors.map((color) => ({
                label: color.name,
                value: color.id,
            }));
        },
    },
    mounted() {
        this.selectedColor = this.colorOptions.find(color => color.value === Number(this.product.color?.id));
        this.selectedSize = this.sizeOptions.find(size => size.value === Number(this.product.size?.id));
        if (this.product.stock_quantity === 0) {
            this.quantity = 0;
        }
    },
    methods: {
        getColorStyle(colour) {
            const findColor = this.productColors.find(color => color.id === colour?.value);
            return findColor ? `background-color: ${findColor.hex_code}` : '';
        },
        updateProduct() {
            this.productService.redirectToProduct(this.similarProducts, this.selectedSize, this.selectedColor);
        },
    },
};
</script>

<style lang="scss">
.gap-1 {
    gap: 10px;
}

.color-option {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: gray;
}

.actions_container {
    display: flex;

    .actions_btn {
        width: 48px;
        height: 48px;
        transition: all .2s ease;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        background-color: #fff;
        padding: 0;
        border: none;
        color: inherit;
        border-radius: 50%;
        cursor: pointer;
        margin-left: 10px;

        svg path {
            transition: .2s ease;
        }

        &:hover {
            background-color: #f2f3f5;
            color: #ff4135;

            svg path {
                fill: #ff4135;
            }
        }
    }
}

.views {
    text-align: left;
    white-space: nowrap;
    font-size: 12px;
    line-height: 14px;
    color: rgb(64, 99, 103)
}
</style>
