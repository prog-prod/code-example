import {CartItem} from "../CartItem";

export interface ICartService {
    calcTotal(): number,

    calcSubTotal(): number,

    getItemActualPrice(item: CartItem): number,

    currency(): String,

    calcSubTotalForItem(item: CartItem): number,

    calcSubTotalDiscount(item: CartItem): number,
}
