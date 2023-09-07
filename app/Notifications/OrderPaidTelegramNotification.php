<?php

namespace App\Notifications;

use App\Contracts\NotificationByTelegramInterface;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use App\Models\Payment;
use App\Notifications\Channels\TelegramChannel;
use App\Notifications\Channels\TelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderPaidTelegramNotification extends Notification implements NotificationByTelegramInterface
{
    use Queueable;

    private Order $order;
    private ?Payment $payment;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->payment = $order->payment;
        $order->load('payment', 'payment.transactions');
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->content($this->getContent());
    }

    private function getContent(): string
    {
        $transactionsCount = $this->order->payment->transactions ? $this->order->payment->transactions->count() : 0;
        $paidAmount = $this->order->payment->paidAmount->getAmount()->toInt();
        $paymentAmount = $this->order->payment->amount->getAmount()->toInt();
        $currency = $this->order->payment->currency_name;
        $orderId = $this->order->id;

        if ($this->payment->status === PaymentStatusEnum::SUCCESS->value) {
            $status = OrderStatusEnum::from($this->order->status)->getLabel();
            return
                "Замовлення: {$orderId} - ОПЛАЧЕНО\n" .
                "Оплачено: {$paidAmount} / {$paymentAmount} {$currency} \n" .
                "Транзакцій здійснено: {$transactionsCount} \n" .
                "Статус замовлення змінився на \"{$status}\"\n" .
                "Перейти: " . route(
                    "admin.orders.show",
                    $this->order->id
                );
        } else {
            if ($this->payment->status === PaymentStatusEnum::OVERPAID->value) {
                $status = OrderStatusEnum::from($this->order->status)->getLabel();
                return
                    "Замовлення: {$orderId} - ПЕРЕПЛАЧЕНО \n" .
                    "Оплачено: {$paidAmount} / {$paymentAmount} {$currency} \n" .
                    "Транзакцій здійснено: {$transactionsCount} \n" .
                    "Статус замовлення змінився на \"{$status}\" \n" .
                    "Перейти: " . route(
                        "admin.orders.show",
                        $this->order->id
                    );
            } else {
                return
                    "Замовлення: {$orderId} - ОПЛАЧЕНО НЕ ПОВНІСТЮ\n" .
                    "Оплачено: {$paidAmount} / {$paymentAmount} {$currency} \n" .
                    "Транзакцій здійснено: {$transactionsCount} \n" .
                    "Статус замовлення не змінився\n" .
                    "Перейти: " . route(
                        "admin.orders.show",
                        $this->order->id
                    );
            }
        }
    }
}
