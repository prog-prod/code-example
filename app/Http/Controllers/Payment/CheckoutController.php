<?php

namespace App\Http\Controllers\Payment;

use App\Contracts\CartServiceInterface;
use App\Contracts\CustomerServiceInterface;
use App\Contracts\DeliveryServiceInterface;
use App\Contracts\OrderServiceInterface;
use App\Contracts\PaymentMethodRepositoryInterface;
use App\Contracts\PaymentServiceInterface;
use App\Contracts\PhoneConfirmationServiceInterface;
use App\Events\OrderCreated;
use App\Http\Controllers\BaseController;
use App\Http\Requests\SubmitCheckoutRequest;
use App\Http\Resources\DeliveryResource;
use App\Http\Resources\PaymentMethodResource;
use App\Services\PhoneConfirmationService;
use Auth;

class CheckoutController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        DeliveryServiceInterface $deliveryService,
        PaymentServiceInterface $paymentMethod,
        PhoneConfirmationServiceInterface $phoneConfirmationService
    ) {
        return $this->showView('Payment/Checkout', [
            'deliveryMethods' => DeliveryResource::collection($deliveryService->getMethods()),
            'paymentMethods' => PaymentMethodResource::collection($paymentMethod->getMethods()),
            'isVerifiedPhone' => session('isVerifiedPhone'),
            'cachedPhones' => $phoneConfirmationService->getCachedPhones()
        ]);
    }

    public function submitCheckoutForm(
        SubmitCheckoutRequest $request,
        CustomerServiceInterface $customerService,
        PhoneConfirmationService $phoneConfirmationService,
        OrderServiceInterface $orderService,
        CartServiceInterface $cartService,
        PaymentServiceInterface $paymentService,
        PaymentMethodRepositoryInterface $paymentMethodRepository
    ) {
        $data = $request->validated();

        if (!$phoneConfirmationService->checkPhoneVerification($data['phone'], $data['confirm_phone_code'])) {
            return back()->withInput()->withErrors(['phone' => __('messages.phone_is_not_verified')]);
        }
        $customer = $customerService->createCustomerIfNotExist([
            "user_id" => Auth::id(),
            'name' => $data['lastName'] . " " . $data['firstName'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $customerService->generateAddress(),
            'city' => $customerService->getCity(),
            'state' => $customerService->getState(),
            'country' => $customerService->getCountry(),
            'postal_code' => $customerService->getPostalCode(),
            'ip' => $customerService->getIpAddress(),
            'currency' => $customerService->getCurrency(),
            'coordinates' => $customerService->getCoordinates(),
        ]);
        $order = $orderService->createOrder($customer, $data);
        if (!$order) {
            return back()->with('error', __('messages.order_not_created'));
        }

        $paymentMethod = $paymentMethodRepository->getPaymentMethodByKey($data['paymentMethod']);
        $paymentService->createPayment($order, $paymentMethod);

        $cartService->clearCart();

        event(new OrderCreated($order));

        if ($data['call_me_back']) {
            return redirect(route('products.index'))->with('success', __('messages.order_successfully_created'));
        }

        return redirect(route('products.index'))->with(
            'success',
            __('messages.order_successfully_created_without_callback')
        );
    }
}
