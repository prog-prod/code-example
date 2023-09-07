import { mapActions } from "vuex";
import { CartService } from "@/Services/CartService.ts";

export default {
    computed: {
        countItems() {
            return this.cartService.countItems();
        },
        cart() {
            return this.$page.props.cart;
        },
        cartService() {
            return new CartService(this.cart);
        },
    },
    methods: {
        ...mapActions({
            toggleCart: "layout/toggleCart",
        }),
        removeItem(e, item) {
            this.$request.send(
                "post",
                route("cart.delete", {
                    product: item.product.id,
                    color: item.color?.id,
                    size: item.size?.id,
                }),
                null,
                {
                    onFinish: () =>
                        this.notifySuccess(this.__("messages.success")),
                }
            );
        },
        addToCart() {
            this.cartService.addToCart(
                this.product,
                this.quantity,
                this.color,
                this.size
            );
        },
    },
};
