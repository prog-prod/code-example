<?php

namespace App\Http\Requests;

use App\Rules\KeyRule;
use Illuminate\Foundation\Http\FormRequest;

class HomePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:256', new KeyRule()],
            'title_uk' => 'nullable|string|max:256',
            'title_en' => 'nullable|string|max:256',
            'description_uk' => 'nullable|string|max:512',
            'description_en' => 'nullable|string|max:512',
            'keywords_uk' => 'nullable|string|max:1024',
            'keywords_en' => 'nullable|string|max:1024',
            'sale_title_uk' => 'nullable|string|max:256',
            'sale_title_en' => 'nullable|string|max:256',
            'sale_text_uk' => 'nullable|string|max:256',
            'sale_text_en' => 'nullable|string|max:256',
            'deal_title_uk' => 'nullable|string|max:256',
            'deal_title_en' => 'nullable|string|max:256',
            'deal_description_uk' => 'nullable|string|max:512',
            'deal_description_en' => 'nullable|string|max:512',
            'sections' => 'array',
            'sections.top_categories' => 'array',
            'sections.top_categories.order' => 'required|numeric',
            'sections.top_categories.active' => 'required|boolean',
            'sections.best_collections' => 'array',
            'sections.best_collections.order' => 'required|numeric',
            'sections.best_collections.active' => 'required|boolean',
            'sections.best_collections.product_ids' => 'array',
            'sections.best_collections.product_ids.*' => 'nullable|exists:products,id',
            'sections.hero_slider' => 'array',
            'sections.hero_slider.order' => 'required|numeric',
            'sections.hero_slider.active' => 'required|boolean',
            'sections.sale' => 'array',
            'sections.sale.order' => 'required|numeric',
            'sections.sale.image' => 'nullable|image|max:8192',
            'sections.sale.active' => 'required|boolean',
            'sections.sale.link' => 'required|string',
            'sections.deal' => 'array',
            'sections.deal.active' => 'required|boolean',
            'sections.deal.order' => 'required|numeric',
            'sections.deal.product_id' => 'required|numeric|exists:products,id',
            'sections.service' => 'array',
            'sections.service.active' => 'required|boolean',
            'sections.service.order' => 'required|numeric',
            'sections.instagram' => 'array',
            'sections.instagram.active' => 'required|boolean',
            'sections.instagram.order' => 'required|numeric',
        ];
    }
}
