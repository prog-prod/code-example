<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image_webp_mobile' => $this->image_webp_mobile,
            'image_jpg_mobile' => $this->image_jpg_mobile,
            'image_webp_desktop' => $this->image_webp_desktop,
            'image_jpg_desktop' => $this->image_jpg_desktop,
            'image_jpg' => $this->image_jpg,
            'link_url' => $this->link_url,
            'title' => $this->title,
            'order' => $this->order,
        ];
    }
}
