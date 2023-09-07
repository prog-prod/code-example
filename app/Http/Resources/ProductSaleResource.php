<?php

namespace App\Http\Resources;

use Brick\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Money $discount
 */
class ProductSaleResource extends JsonResource
{
    private string $model = 'Sale';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'percent' => $this->percent,
            'endDate' => $this->endDate,
            'quantity' => $this->quantity
        ];
    }
}
