import { CartService } from "@/Services/CartService.ts";

export default {
    computed: {
        cart() {
            return this.$page.props.cart;
        },
        cartService() {
            return new CartService(this.cart);
        },
    },
    methods: {
        clearErrors() {
            $(".form-control.error").removeClass("error");
        },
        addToCart() {
            return new Promise((resolve, reject) => {
                this.clearErrors();

                if (!this.selectedColor && this.colorOptions.length > 0) {
                    $("#dropdown-color").addClass("error");
                    this.notifyError(this.__("messages.cart.choose_size"));
                    return reject(this.__("messages.cart.choose_size"));
                }
                if (!this.selectedSize && this.sizeOptions.length > 0) {
                    $("#dropdown-size").addClass("error");
                    this.notifyError(this.__("messages.cart.choose_color"));
                    return reject(this.__("messages.cart.choose_color"));
                }

                this.cartService.addToCart(
                    this.product,
                    this.quantity,
                    this.selectedSize?.value,
                    this.selectedColor?.value
                );
                return resolve(true);
            });
        },
    },
};
