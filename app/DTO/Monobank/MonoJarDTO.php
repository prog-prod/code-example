<?php

namespace App\DTO\Monobank;

class MonoJarDTO
{
    public ?string $id;
    public ?string $sendId;
    public ?string $title;
    public ?string $description;
    public ?int $currencyCode;
    public ?int $balance;
    public ?int $goal;

    /**
     * @param array $jar
     */
    public function __construct(array $jar)
    {
        $this->id = $jar['id'] ?? null;
        $this->sendId = $jar['sendId'] ?? null;
        $this->title = $jar['title'] ?? null;
        $this->description = $jar['description'] ?? null;
        $this->currencyCode = $jar['currencyCode'] ?? null;
        $this->balance = $jar['balance'] ?? null;
        $this->goal = $jar['goal'] ?? null;
    }
}
