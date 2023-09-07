<?php

namespace App\Services;

use App\Contracts\CartServiceInterface;
use App\Contracts\DeliveryServiceInterface;
use App\Contracts\OrderItemRepositoryInterface;
use App\Contracts\OrderRepositoryInterface;
use App\Contracts\OrderServiceInterface;
use App\Contracts\PaymentServiceInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Enums\CurrencyEnum;
use App\Enums\DeliveryEnum;
use App\Enums\OrderStatusEnum;
use App\Events\OrderConfirmed;
use App\Events\PendingPaymentForOrder;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Support\Collection;

class OrderService implements OrderServiceInterface
{
    private OrderRepositoryInterface $repository;
    private CartServiceInterface $cartService;
    private DeliveryServiceInterface $deliveryService;
    private ProductRepositoryInterface $productRepository;
    private OrderItemRepositoryInterface $orderItemRepository;
    private array $quantityMapper = [];
    private Collection $productsInCart;
    private PaymentServiceInterface $paymentService;

    public function __construct()
    {
        $this->repository = app(OrderRepositoryInterface::class);
        $this->cartService = app(CartServiceInterface::class);
        $this->deliveryService = app(DeliveryServiceInterface::class);
        $this->productRepository = app(ProductRepositoryInterface::class);
        $this->orderItemRepository = app(OrderItemRepositoryInterface::class);
        $this->paymentService = app(PaymentServiceInterface::class);
        $this->initOrderProducts();
    }

    /**
     * @return void
     */
    private function initOrderProducts(): void
    {
        $cart = $this->cartService->getItems();
        $ids = collect($cart->items)->map(function ($cartItemResource) {
            if (is_array($cartItemResource)) {
                $this->quantityMapper[$cartItemResource['product']['id']] = $cartItemResource['quantity'];
                return $cartItemResource['product']['id'];
            }
            $this->quantityMapper[$cartItemResource->resource->product_id] = $cartItemResource->resource->quantity;
            return $cartItemResource->resource->product_id;
        })->toArray();
        $this->productsInCart = $this->productRepository->getProductsById($ids);
    }

    /**
     * Generate an order number for the given customer.
     *
     * @param Customer $customer The customer for whom the order number is generated.
     * @return string The generated order number.
     */
    public function generateOrderNumber(Customer $customer): string
    {
        return 'ORD-' . $customer->id . '-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4);
    }

    public function createOrder(Customer $customer, array $data)
    {
        $delivery = $this->deliveryService->findDeliveryByKey($data['deliveryMethod']);
        $orderData = [
            'customer_id' => $customer->id,
            'delivery_id' => $delivery?->id,
            'delivery_details' => $this->getDeliveryDetailsJson($data),
            'order_number' => $this->generateOrderNumber($customer),
            'total_price' => $this->countOrderTotalPrice($this->productsInCart, $this->quantityMapper),
            'currency_name' => CurrencyEnum::UAH->value,
            'notes' => $data['notes'] ?? null,
            'callback' => $data['call_me_back'] ?? true,
            'status' => OrderStatusEnum::PENDING->value,
        ];

        $order = $this->repository->createOrder($orderData);
        $orderItemsData = $this->getOrderItemsData($order, $this->productsInCart, $this->quantityMapper);

        $this->orderItemRepository->createOrderItems($orderItemsData);

        return $order;
    }


    /**
     * @param Product[] $products
     * @param array $quantityMapper
     * @return int
     */
    public function countOrderTotalPrice(array|Collection $products, array $quantityMapper): int
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $this->cartService->calcProductPrice(
                $product,
                $quantityMapper[$product->id]
            );
        }
        return $totalPrice;
    }

    private function getDeliveryDetailsJson($data): array
    {
        switch ($data['deliveryMethod']) {
            case DeliveryEnum::NOVAPOSHTA_DEPARTMENT->value:
                return [
                    'deliveryDepartment' => $data['deliveryDepartment'],
                    'deliveryDepartmentCity' => $data['deliveryDepartmentCity']
                ];
            default:
            case DeliveryEnum::NOVAPOSHTA_COURIER->value:
                return [
                    'city' => $data['city'],
                    'street' => $data['street'],
                    'house' => $data['house'],
                    'flat' => $data['flat']
                ];
        }
    }

    /**
     * @param Order $order
     * @param Collection $products
     * @param array $quantityMapper
     * @return array
     */
    public function getOrderItemsData(Order $order, Collection $products, array $quantityMapper): array
    {
        $orderItems = [];
        $timestamp = now();
        foreach ($products as $product) {
            $quantity = $quantityMapper[$product->id];
            $price = $this->cartService->calcProductPrice($product, $quantity);
            $orderItems[] = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        return $orderItems;
    }

    public function setOrderCanceled(Order $order, string $reason): void
    {
        $this->paymentService->cancelPayment($order->payment);
        $order->status = OrderStatusEnum::CANCELED->value;
        $order->reason = $reason;
        $order->save();
    }

    /**
     * @throws Exception
     */
    public function confirmOrder(Order $order): bool
    {
        $payment = $order->payment;
        if (!$payment->paymentMethod->isCash() && !$payment->isSuccess()) {
            $order->status = OrderStatusEnum::PENDING_PAYMENT->value;
            if ($saved = $order->save()) {
                event(new PendingPaymentForOrder($order));
                return $saved;
            }
        } else {
            if ($payment->paymentMethod->isCash() || $payment->isSuccess()) {
                $order->status = OrderStatusEnum::PROCESSING->value;
                if ($saved = $order->save()) {
                    event(new OrderConfirmed($order));
                    return $saved;
                }
            }
        }
        return false;
    }
}
