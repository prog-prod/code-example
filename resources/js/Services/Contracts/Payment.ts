import { Price } from "./Price";
import { PaymentMethod } from "./PaymentMethod";

export interface Payment {
    amount: Price;
    overpaid: Price | null;
    payment_method: PaymentMethod;
    status: number;
}
