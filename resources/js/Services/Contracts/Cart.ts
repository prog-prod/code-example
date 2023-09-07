import { Price } from "./Price";
import { CartItem } from "./CartItem";

export interface Cart {
    items: CartItem[];
    taxes: Price[];
    delivery: number;
    deliveryTaxes: Boolean;
    deliveryDate: string;
}
