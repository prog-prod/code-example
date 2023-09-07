<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LayoutResource extends JsonResource
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
            'address' => $this->address,
            'top_header_text' => $this->top_header_text,
            'header_logo' => $this->header_logo,
            'footer_logo' => $this->footer_logo,
            'top_ads_status' => $this->top_ads_status,
            'top_ads_image' => $this->top_ads_image,
            'top_ads_link' => $this->top_ads_link,
            'top_ads_bg_color' => $this->top_ads_bg_color,
            'phones' => $this->phones,
            'emails' => $this->emails,
        ];
    }
}
