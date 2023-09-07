<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\MonobankServiceInterface;
use App\Contracts\OrderServiceInterface;
use App\Contracts\PaymentServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['order'])->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'payment_method_id' => 'required',
            'status' => 'required',
            'order_id' => 'required',
            'amount' => 'required',
        ]);

        $payment = Payment::create($validatedData);

        return redirect()->route('admin.payments.show', $payment->id);
    }

    public function show(Payment $payment, NovaPoshtaService $novaPoshtaService)
    {
        $payment->load(['order', 'paymentMethod', 'transactions']);
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validatedData = $request->validate([
            'payment_method_id' => 'required',
            'status' => 'required',
            'order_id' => 'required',
            'amount' => 'required',
        ]);

        $payment->update($validatedData);

        return redirect()->route('admin.payments.show', $payment->id);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
    }

    public function confirmPayment(
        Payment $payment,
        PaymentServiceInterface $paymentService,
        OrderServiceInterface $orderService,
        MonobankServiceInterface $monoService
    ) {
        $order = $payment->order;
        $data = $monoService->getMockDataTransactionMonobank(
            $order,
            $payment->paidExtraAmount->getMinorAmount()->toInt()
        );

        $paymentService->addTransactionForPayment($payment, $data);
        $paymentService->setPaymentSuccess($payment->fresh());
        $result = $orderService->confirmOrder($order->fresh());

        if ($result) {
            return back()->with('success', 'Payment confirmed successfully');
        }
        return back()->with('error', 'Payment not confirmed successfully');
    }
}
