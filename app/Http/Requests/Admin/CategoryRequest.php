<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category = $this->route('category');
        $categoryId = $category ? $category->id : null;

        return [
            'key' => "required|unique:categories,key,{$categoryId}|string|max:255",
            'name_uk' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_uk' => 'nullable|string',
            'description_en' => 'nullable|string',
            'parent_id' => 'nullable|integer|min:0',
            'image' => 'image|mimes:jpeg,png,jpg'
        ];
    }
}
