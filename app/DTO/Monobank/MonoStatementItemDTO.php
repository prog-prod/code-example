<?php

namespace App\DTO\Monobank;

class MonoStatementItemDTO
{
    public ?string $id;
    public ?int $time;
    public ?string $description;
    public ?string $comment;
    public ?int $mcc;
    public ?int $originalMcc;
    public ?int $amount;
    public ?int $operationAmount;
    public ?int $currencyCode;
    public ?int $commissionRate;
    public ?int $cashbackAmount;
    public ?int $balance;
    public ?bool $hold;
    public ?string $invoiceId;
    public ?string $counterEdrpou;
    public ?string $counterIban;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->time = $data['time'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->comment = $data['comment'] ?? null;
        $this->mcc = $data['mcc'] ?? null;
        $this->originalMcc = $data['originalMcc'] ?? null;
        $this->amount = $data['amount'] ?? null;
        $this->operationAmount = $data['operationAmount'] ?? null;
        $this->currencyCode = $data['currencyCode'] ?? null;
        $this->commissionRate = $data['commissionRate'] ?? null;
        $this->cashbackAmount = $data['cashbackAmount'] ?? null;
        $this->balance = $data['balance'] ?? null;
        $this->hold = $data['hold'] ?? null;
        $this->invoiceId = $data['invoiceId'] ?? null;
        $this->counterEdrpou = $data['counterEdrpou'] ?? null;
        $this->counterIban = $data['counterIban'] ?? null;
    }
}
