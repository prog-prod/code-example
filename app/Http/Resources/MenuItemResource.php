<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'key' => $this->key,
            'name' => $this->name,
            'link' => $this->link,
            'mega' => $this->mega,
            'image' => $this->image,
            'children' => $this->whenLoaded('children', MenuItemResource::collection($this->children))
        ];
    }
}
