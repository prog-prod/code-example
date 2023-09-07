import { ProductService } from "@/Services/ProductService.ts";

export default {
    data: () => ({}),
    computed: {
        defaultProductImg: () => this.productService.defaultProductImage,
        productService() {
            return new ProductService(this.product);
        },
        productLink() {
            return this.productService.getProductLink();
        },
    },
    methods: {
        productImage(img) {
            if (!img) img = this.defaultProductImg;

            return this.assetStorage(img);
        },
        getMainImage(product) {
            return this.productService.getMainImage(product);
        },
        removeFromWishlist() {
            this.$request.send(
                "post",
                route("wishlist.delete", { product: this.product.id }),
                null,
                {
                    preserveScroll: true,
                    onFinish: () => {
                        this.notifySuccess(this.__("messages.success"));
                    },
                }
            );
        },
        addToWishlist() {
            this.$request.send(
                "post",
                route("wishlist.add", this.product),
                null,
                {
                    preserveScroll: true,
                    onFinish: () =>
                        this.notifySuccess(this.__("messages.success")),
                }
            );
        },
        addToComparisons() {
            this.$request.send(
                "post",
                route("comparisons.add", this.product),
                null,
                {
                    preserveScroll: true,
                    onFinish: () =>
                        this.notifySuccess(this.__("messages.success")),
                }
            );
        },
        removeFromComparisons() {
            this.$request.send(
                "post",
                route("comparisons.delete", { product: this.product.id }),
                null,
                {
                    preserveScroll: true,
                    onFinish: () =>
                        this.notifySuccess(this.__("messages.success")),
                }
            );
        },
    },
};
