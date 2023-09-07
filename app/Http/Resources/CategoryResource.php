<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = [
            'id' => $this->id,
            'key' => $this->key,
            'name' => $this->name,
            'image' => $this->image,
            'url' => route('category.show', ['category' => $this->key]),
            'children' => CategoryResource::collection($this->children)
        ];
        if ($this->products_count) {
            $fields['products_count'] = $this->products_count;
        }
        return $fields;
    }
}
