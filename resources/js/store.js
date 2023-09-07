import { createStore } from "vuex";
import layout from "./modules/layout.js";
import products from "@/modules/products.js";
import profile from "@/modules/profile.js";
import checkout from "@/modules/checkout.js";

export const store = createStore({
    modules: {
        layout,
        products,
        profile,
        checkout,
    },
});
