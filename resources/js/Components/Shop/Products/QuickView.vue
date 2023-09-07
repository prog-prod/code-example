<template>
    <ModalVue v-model="show" @close="closeModal">
        <div id="quickView" class="quickview">
            <div v-if="product" class="row w-100">
                <div
                    class="col-lg-6 col-md-6 mb-5 mb-md-0 pl-5 pt-4 pt-lg-0 pl-lg-0 text-center"
                >
                    <img
                        v-if="image"
                        :src="assetStorage(image)"
                        alt="product-img"
                        class="img-fluid product-img"
                    />
                    <img
                        v-else
                        class="img-fluid w-100 mb-3"
                        :class="key === 0 ? 'img-first' : 'img-first'"
                        :src="asset(defaultProductImg)"
                        alt="product-img"
                    />
                </div>
                <div
                    class="col-lg-5 col-md-6 text-center text-md-left align-self-center py-5 pl-5"
                >
                    <Link :href="productLink"
                    ><h3 class="mb-lg-2 mb-2">
                        {{ product.name }}
                    </h3></Link
                    >
                    <ProductStatus v-bind="{ product }"/>
                    <RatingComponent v-bind="{ product }"/>
                    <div class="mt-2">
                        <ProductPriceComponent v-bind="{ product, quantity }"/>
                    </div>
                    <p class="mb-lg-4 mb-3 text-gray" v-html="product?.description">
                    </p>
                    <div
                        class="d-flex flex-column flex-sm-row justify-content-between mb-4"
                    >
                        <QuantityInput
                            v-model="quantity"
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
                        />
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
                    <a
                        href="#"
                        class="btn btn-primary mb-4"
                        @click.prevent="addToCartAndClose();"
                    >
                        {{ __('product.details.add_to_cart') }}
                    </a>
                    <ul class="list-inline social-icon-alt">
                        <li class="list-inline-item">
                            <a href="#"><i class="ti-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="ti-twitter-alt"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="ti-vimeo-alt"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="ti-google"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </ModalVue>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import ProductPriceComponent from '@/Components/Shop/Product/ProductPriceComponent.vue';
import ProductStatus from '@/Components/Shop/Product/ProductStatus.vue';
import {Link} from '@inertiajs/vue3';
import QuantityInput from '@/Components/Cart/QuantityInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import productDetails from '@/Mixins/productDetails.js';
import ModalVue from '@/Components/UI/ModalVue.vue';
import RatingComponent from '@/Components/UI/RatingComponent.vue';
import product from '@/Mixins/product.js';
import {ProductService} from '@/Services/ProductService.ts';

export default {
    name: 'QuickView',
    components: {
        Link,
        RatingComponent,
        ProductPriceComponent,
        ProductStatus,
        QuantityInput,
        Dropdown,
        ModalVue,
    },

    mixins: [product, productDetails],
    data: () => ({
        quantity: 1,
        selectedColor: null,
        selectedSize: null,
        productSizes: [],
        productColors: [],
        similarProducts: [],
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
        ...mapGetters({
            product: 'products/quickViewProduct',
            show: 'products/isShowQuickView',
        }),
        image() {
            return this.product?.main_image?.filename;
        },
        currency() {
            return this.product?.price?.symbol;
        },
    },
    watch: {
        product() {
            this.fetchData();
            this.quantity = 1;
        },
    },
    methods: {
        ...mapActions({
            toggleQuickView: 'products/toggleQuickView',
        }),
        updateProduct() {
            this.productService.redirectToProduct(this.similarProducts, this.selectedSize, this.selectedColor);
            this.toggleQuickView();
        },
        closeModal() {
            this.toggleQuickView();
        },
        addToCartAndClose() {

            this.addToCart().then(() => {
                this.closeModal();
            });
        },
        fetchData() {
            return this.$request.axios.get(route('products.get-quick-view-data', this.product?.id)).then(({data}) => {
                const {similarProducts, productColors, productSizes} = data;

                this.similarProducts = similarProducts;
                this.productColors = productColors;
                this.productSizes = productSizes;

                this.selectedColor = this.colorOptions.find(color => color.value === Number(this.product.color?.id));
                this.selectedSize = this.sizeOptions.find(size => size.value === Number(this.product.size?.id));
            });
        },
    },

};
</script>

<style scoped>
.product-img {
    max-width: 560px;
    width: 100%;
}
</style>
