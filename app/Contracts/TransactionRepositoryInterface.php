<?php

namespace App\Contracts;

use App\Models\Payment;

interface TransactionRepositoryInterface
{
    public function createTransaction(
        Payment $payment,
        string $accountType,
        string $accountId,
        int $amount,
        string $comment,
        string $currency,
        array $details
    );

}
