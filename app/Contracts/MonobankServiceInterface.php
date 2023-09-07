<?php

namespace App\Contracts;

use App\DTO\Monobank\MonoAccountDTO;
use App\DTO\Monobank\MonoAccountInfoResponseDTO;
use App\DTO\Monobank\MonoStatementResponseDTO;
use App\Models\Order;

interface MonobankServiceInterface
{
    public function getInfo(): MonoAccountInfoResponseDTO;

    public function getCurrency(): array;

    public function setWebhook(?string $url = null): bool;

    public function getExtract(string $accountId, ?int $from = null, ?int $to = null);

    public function getOrderIdFromMonoStatement(string $comment);

    public function updateOrderPayment(MonoStatementResponseDTO $data);

    public function findAccount(string $accountId): ?MonoAccountDTO;

    public function getMockDataTransactionMonobank(Order $order, ?int $minorAmount = null): MonoStatementResponseDTO;

}
