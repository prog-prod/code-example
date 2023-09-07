<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "orders" => $this->whenLoaded('orders', OrderResource::collection($this->orders)),
            "addresses" => $this->whenLoaded('addresses', UserAddressResource::collection($this->addresses)),
            "name" => $this->name,
            "full_name" => $this->fullName,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "middle_name" => $this->middle_name,
            "country" => new CountryResource($this->country),
            "login" => $this->login,
            "phone" => $this->phone,
            "sex" => $this->sex,
            "zip" => $this->zip,
            "birthday" => $this->birthday,
            "avatar" => $this->avatar,
            "email" => $this->email,
            "phone_verified_at" => $this->phone_verified_at,
        ];
    }
}
