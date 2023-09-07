import { Price } from "./Price";
import { Product } from "./Product";

export interface OrderItem {
    created_at: string;
    id: number;
    price: Price;
    product: Product;
    quantity: number;
}
