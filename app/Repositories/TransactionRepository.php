<?php

namespace App\Repositories;

use App\Contracts\TransactionRepositoryInterface;
use App\Models\Payment;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{

    public function createTransaction(
        Payment $payment,
        string $accountType,
        string $accountId,
        int $amount,
        string $comment,
        string $currency,
        array $details
    ) {
        return Transaction::query()->create([
            'payment_id' => $payment->id,
            'account_type' => $accountType,
            'account_id' => $accountId,
            'amount' => $amount,
            'comment' => $comment,
            'currency_name' => $currency,
            'details' => $details
        ]);
    }
}
