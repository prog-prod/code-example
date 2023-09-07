import { Price } from "./Price";
import { Currency } from "./Currency";
import { Customer } from "./Customer";
import { OrderItem } from "./OrderItem";
import { Payment } from "./Payment";
import { OrderStatusType } from "../Types/OrderStatusType";

export interface Order {
    created_at: string;
    currency: Currency;
    customer: Customer;
    id: number;
    items: Array<OrderItem>;
    notes: string;
    order_number: string;
    status: OrderStatusType;
    total_price: Price;
    payment: Payment;
}
