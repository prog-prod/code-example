<?php

namespace App\Http\Controllers\Profile;

use App\Contracts\OrderServiceInterface;
use App\Enums\ReasonsCancelOrderEnum;
use App\Events\OrderCanceled;
use App\Http\Controllers\BaseController;
use App\Models\Order;
use Auth;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth('web')->check()) {
            auth('web')->user()->load(
                [
                    'orders.currency',
                    'orders.orderItems.product',
                    'orders.payment',
                    'orders.payment.paymentMethod',
                    'orders.orderItems.product'
                ]
            );
        }
        return $this->showView('Profile/Order');
    }

    public function cancelOrder(Order $order, OrderServiceInterface $orderService)
    {
        $reason = ReasonsCancelOrderEnum::REJECTION_BY_CLIENT->getLabel();
        $orderService->setOrderCanceled($order, $reason);

        event(new OrderCanceled($order));

        return back()->with('success', 'Замовлення успішно скасовано.');
    }
}
