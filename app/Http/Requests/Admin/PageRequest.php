<?php

namespace App\Http\Requests\Admin;

use App\Rules\KeyRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:256', new KeyRule()],
            'layout_id' => 'required|numeric|exists:layouts,id',
            'title_uk' => 'nullable|string|max:256',
            'title_en' => 'nullable|string|max:256',
            'description_uk' => 'nullable|string|max:512',
            'description_en' => 'nullable|string|max:512',
            'keywords_uk' => 'nullable|string|max:1024',
            'keywords_en' => 'nullable|string|max:1024',
            'sections' => 'nullable|json',
        ];
    }
}
