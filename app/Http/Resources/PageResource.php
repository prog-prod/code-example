<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'sections' => $this->sections->values(),
            'deal_title' => $this->deal_title,
            'deal_description' => $this->deal_description,
            'sale_title' => $this->sale_title,
            'sale_text' => $this->sale_text,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'layout' => $this->whenLoaded('layout', new LayoutResource($this->layout))
        ];
    }
}
