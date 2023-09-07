<?php

namespace App\DTO\Monobank;

class MonoAccountDTO
{

    public ?string $id;
    public ?string $sendId;
    public ?int $currencyCode;
    public ?string $cashbackType;
    public ?int $balance;
    public ?int $creditLimit;
    public ?array $maskedPan;
    public ?string $type;


    public string $iban;

    /**
     * @param array $account
     */
    public function __construct(array $account)
    {
        $this->id = $account['id'] ?? null;
        $this->sendId = $account['sendId'] ?? null;
        $this->currencyCode = $account['currencyCode'] ?? null;
        $this->cashbackType = $account['cashbackType'] ?? null;
        $this->balance = $account['balance'] ?? null;
        $this->creditLimit = $account['creditLimit'] ?? null;
        $this->maskedPan = $account['maskedPan'] ?? null;
        $this->type = $account['type'] ?? null;
        $this->iban = $account['iban'] ?? 0;
    }
}
