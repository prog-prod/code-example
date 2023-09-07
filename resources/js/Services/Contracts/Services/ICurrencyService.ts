import {CartItem} from "../CartItem";
import {Product} from "../Product";

export interface ICurrencyService {
    getItemActualPrice(item: Product): number,

    calcSubTotalForItem(item: CartItem): number,

    calcSubTotalDiscount(item: CartItem): number,
}
