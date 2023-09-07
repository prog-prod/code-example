<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrintCategoryResource extends JsonResource
{
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
            'img' => $this->image,
            'url' => $this->key ? route('print-category.show', ['printCategory' => $this->key]) : null,
            'children' => PrintCategoryResource::collection($this->children)
        ];
        if ($this->products_count) {
            $fields['products_count'] = $this->products_count;
        }
        return $fields;
    }
}
