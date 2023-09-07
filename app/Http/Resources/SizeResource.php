<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
{
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            "id" => $this->id,
            "name" => $this->name,
        ];

        if ($this->relationLoaded('pivot')) {
            $data['quantity'] = $this->pivot->quantity;
        }

        return $data;
    }
}
