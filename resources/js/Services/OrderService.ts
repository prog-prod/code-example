import { Order } from "./Contracts/Order";
import { PaymentStatuses } from "./../enums/PaymentStatuses";
import { OrderStatuses } from "./../enums/OrderStatusesEnum";

export class OrderService {
    public static canUserCancelOrder(order: Order) {
        return (
            [PaymentStatuses.PENDING, PaymentStatuses.FAILED].includes(
                Number(order.payment.status)
            ) &&
            [OrderStatuses.PENDING, OrderStatuses.PENDING_PAYMENT].includes(
                Number(order.status)
            )
        );
    }
}
