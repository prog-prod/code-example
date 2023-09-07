<?php

namespace App\Http\Requests;

use App\Rules\KeyRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactPageRequest extends FormRequest
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
            'deal_title_uk' => 'nullable|string|max:256',
            'deal_title_en' => 'nullable|string|max:256',
            'deal_description_uk' => 'nullable|string|max:512',
            'deal_description_en' => 'nullable|string|max:512',
            'sections' => 'array',
            'sections.google_maps' => 'array',
            'sections.google_maps.active' => 'required|boolean',
            'sections.google_maps.order' => 'required|numeric',
            'sections.contact_form' => 'array',
            'sections.contact_form.active' => 'required|boolean',
            'sections.contact_form.order' => 'required|numeric',
        ];
    }
}
