<?php

namespace App\Http\Resources;

use App\Facades\CurrencyFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'overpaid' => CurrencyFacade::getPriceObject($this->overpaidAmount),
            'amount' => CurrencyFacade::getPriceObject($this->amount),
            'payment_method' => new PaymentMethodResource($this->whenLoaded('paymentMethod')),
        ];
    }
}
