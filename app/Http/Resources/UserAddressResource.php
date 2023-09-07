<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
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
            'city' => $this->city,
            'full_address' => $this->full_address,
            'street' => $this->street,
            'house' => $this->house,
            'flat' => $this->flat,
            'default' => $this->default,
            'created_at' => $this->created_at
        ];
    }
}
