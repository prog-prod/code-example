<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'autoplay' => $this->autoplay,
            'lazyLoad' => $this->lazyLoad,
            'autoplay_speed' => $this->autoplay_speed,
            'speed' => $this->speed,
            'pause_on_focus' => $this->pause_on_focus,
            'pause_on_hover' => $this->pause_on_hover,
            'infinite' => $this->infinite,
            'arrows' => $this->arrows,
            'dots' => $this->dots,
            'slides' => $this->whenLoaded('slides', function () {
                return SlideResource::collection($this->slides);
            })
        ];
    }
}
