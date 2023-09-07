<?php

namespace App\DTO\NovaPoshta;

class NpDocumentPriceDTO
{
    public int $cost;
    public int $assessedCost;

    /**
     * @param int $cost
     * @param int $assessedCost
     */
    public function __construct(int $cost, int $assessedCost)
    {
        $this->cost = $cost;
        $this->assessedCost = $assessedCost;
    }
}
