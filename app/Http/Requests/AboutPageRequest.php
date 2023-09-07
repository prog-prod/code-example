<?php

namespace App\Http\Requests;

use App\Rules\KeyRule;
use Illuminate\Foundation\Http\FormRequest;

class AboutPageRequest extends FormRequest
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
            'sections' => 'array',
            'sections.about' => 'array',
            'sections.about.order' => 'required|numeric',
            'sections.about.active' => 'required|boolean',
            'sections.about.image' => 'nullable|image|max:4096',
            'sections.sale' => 'array',
            'sections.sale.order' => 'required|numeric',
            'sections.sale.active' => 'required|boolean',
            'sections.sale.link' => 'required|string',
            'sections.sale.image' => 'nullable|image|max:8192',
            'sections.team' => 'array',
            'sections.team.active' => 'required|boolean',
            'sections.team.order' => 'required|numeric',
        ];
    }
}
