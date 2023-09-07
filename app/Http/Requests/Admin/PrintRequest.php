<?php

namespace App\Http\Requests\Admin;

use App\Rules\KeyRule;
use Illuminate\Foundation\Http\FormRequest;

class PrintRequest extends FormRequest
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
        $category = $this->route('print'); // get the current category record
        $categoryId = $category ? $category->id : null;

        return [
            'key' => ["required", "max:255", "unique:print_images,key,$categoryId", new KeyRule()],
            'name_uk' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_uk' => 'nullable|string',
            'description_en' => 'nullable|string',
            'print_category_id' => 'required|exists:print_categories,id',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
