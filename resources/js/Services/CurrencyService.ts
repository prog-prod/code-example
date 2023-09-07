import { CartItem } from "./Contracts/CartItem";
import { ICurrencyService } from "./Contracts/Services/ICurrencyService";
import { Product } from "./Contracts/Product";

export class CurrencyService implements ICurrencyService {
    getItemActualPrice(product: Product) {
        return product.price_with_discount
            ? product.price_with_discount.amount
            : product.price.amount;
    }

    calcSubTotalForItem(item: CartItem) {
        if (!item.product) return 0;
        return item.product.price.amount * item.quantity;
    }

    calcSubTotalDiscount(item: CartItem) {
        if (
            !item.product ||
            !item.product.price_with_discount ||
            !item.product.sale
        ) {
            return 0;
        }
        if (item.quantity <= item.product.sale.quantity) {
            return item.product.price_with_discount.amount * item.quantity;
        }
        return (
            item.product.price_with_discount.amount *
                item.product.sale.quantity +
            item.product.price.amount *
                (item.quantity - item.product.sale.quantity)
        );
    }
}
