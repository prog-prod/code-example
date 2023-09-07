<?php

namespace App\Http\Resources;

use App\Facades\CurrencyFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'items' => OrderItemResource::collection($this->whenLoaded('orderItems')),
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'order_number' => $this->order_number,
            'total_price' => CurrencyFacade::getPriceObject($this->total_price),
            'currency' => new CurrencyResource($this->whenLoaded('currency')),
            'payment' => new PaymentResource($this->whenLoaded('payment')),
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d.m.Y H:i')
        ];
    }
}
