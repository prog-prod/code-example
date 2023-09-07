<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CustomerRepositoryInterface;
use App\Contracts\OrderItemRepositoryInterface;
use App\Contracts\OrderServiceInterface;
use App\Contracts\PaymentMethodRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Enums\ReasonsCancelOrderEnum;
use App\Events\OrderCanceled;
use App\Http\Requests\Admin\CreateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends BaseAdminController
{
    private OrderItemRepositoryInterface $orderItemRepository;
    private ProductRepositoryInterface $productRepository;
    private OrderServiceInterface $orderService;

    public function __construct(
        OrderItemRepositoryInterface $orderItemRepository,
        ProductRepositoryInterface $productRepository,
        OrderServiceInterface $orderService,
    ) {
        $this->orderItemRepository = $orderItemRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = Order::with(['orderItems', 'payment', 'payment.paymentMethod'])->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(CreateOrderRequest $request)
    {
        $validatedData = $request->validated();

        $order = Order::create($validatedData);

        return redirect()->route('admin.orders.show', $order);
    }

    public function show(Order $order)
    {
        $order->load(['orderItems', 'payment', 'payment.paymentMethod']);
        $payment = $order->payment;

        return view('admin.orders.show', compact('order', 'payment'));
    }

    public function edit(
        Order $order,
        CustomerRepositoryInterface $customerRepository,
        PaymentMethodRepositoryInterface $paymentMethodRepository
    ) {
        $customers = $customerRepository->getAllCustomers();
        $paymentMethods = $paymentMethodRepository->getAllPaymentMethods();
        $products = $this->productRepository->getAllProducts();
        $order->load(['payment', 'payment.paymentMethod', 'orderItems']);
        return view('admin.orders.edit', compact('order', 'customers', 'paymentMethods', 'products'));
    }

    public function update(CreateOrderRequest $request, Order $order)
    {
        $validatedData = $request->validated();
        $order->load(['orderItems']);
        $order->update($validatedData);
        $this->updateOrderItems($order, $validatedData['order_items'], $validatedData['quantity_mapper']);

        return redirect()->route('admin.orders.edit', $order);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index');
    }

    public function confirmOrder(Order $order, OrderServiceInterface $orderService)
    {
        try {
            if ($orderService->confirmOrder($order)) {
                return back()->with('success', 'Замовлення успішно підтверджено.');
            }
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('error', 'Не можливо підтвердити замовлення.');
    }

    public function cancelOrder(Request $request, Order $order, OrderServiceInterface $orderService)
    {
        $request->validate([
            'reason' => 'in:' . join(',', ReasonsCancelOrderEnum::getValues()),
            'other_reason' => 'nullable|string',
            'notify_customer' => 'nullable'
        ]);
        if ($request->reason === ReasonsCancelOrderEnum::OTHER->value) {
            $reason = ReasonsCancelOrderEnum::from($request->reason)->getLabel() . " " . $request->other_reason;
        } else {
            $reason = ReasonsCancelOrderEnum::from($request->reason)->getLabel();
        }

        $orderService->setOrderCanceled($order, $reason);

        if ($request->notify_customer && $request->notify_customer == 'on') {
            event(new OrderCanceled($order));
        }

        return back()->with('success', 'Замовлення успішно скасовано.');
    }

    private function updateOrderItems(Order $order, mixed $order_items, array $quantityMapper = [])
    {
        $differ_remove = $order->orderItems->pluck('product_id')->diff($order_items);
        $differ_new = collect($order_items)->diff($order->orderItems->pluck('product_id'));
        if ($differ_new->isNotEmpty()) {
            $products = $this->productRepository->getProductsById($differ_new->toArray());
            $orderItems = $this->orderService->getOrderItemsData($order, $products, $quantityMapper);
            if ($this->orderItemRepository->createOrderItems($orderItems)) {
                $total_amount = $this->orderService->countOrderTotalPrice($products, $quantityMapper);

                $order->total_price = $total_amount;
                $order->save();
                $order->payment->amount = $total_amount;
                $order->payment->save();
            }
        } else {
            if (collect($order_items)->isNotEmpty()) {
                $products = $this->productRepository->getProductsById($order_items);
                foreach ($quantityMapper as $product_id => $quantity) {
                    $item = $order->orderItems->where('product_id', $product_id)->first();
                    $item->quantity = $quantity;
                    $item->save();
                }
                $total_amount = $this->orderService->countOrderTotalPrice($products, $quantityMapper);

                $order->total_price = $total_amount;
                $order->save();
                $order->payment->amount = $total_amount;
                $order->payment->save();
            }
        }
        if ($differ_remove->isNotEmpty()) {
            $this->orderItemRepository->removeOrderItems($order->orderItems->whereIn('product_id', $differ_remove));
        }
    }
}
