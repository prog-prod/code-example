<?php

namespace App\DTO\Monobank;

class MonoStatementResponseDTO
{
    public ?string $account;
    public ?MonoStatementItemDTO $statementItem;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->account = $data['account'] ?? null;
        $this->statementItem = new MonoStatementItemDTO($data['statementItem'] ?? null);
    }
}
