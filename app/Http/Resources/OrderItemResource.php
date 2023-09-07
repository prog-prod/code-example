<?php

namespace App\Http\Resources;

use App\Facades\CurrencyFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'price' => CurrencyFacade::getPriceObject($this->price),
            'product' => new ProductResource($this->whenLoaded('product')),
            'created_at' => $this->created_at->format('d.m.Y H:i'),
        ];
    }
}
